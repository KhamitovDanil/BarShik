<?php
session_start();
require_once 'functions.php';
$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_SESSION["user_id"];
    $userEmail = $_SESSION["user_email"]; // Получаем адрес электронной почты пользователя из сессии
    $orderContent = json_decode($_POST['order_content'], true); // Получаем содержимое корзины

    // Проверяем наличие total_cost в POST
    if (isset($_POST['total_cost'])) {
        $totalCost = floatval($_POST['total_cost']); // Преобразуем в число
        echo "Total cost: {$totalCost}<br>"; // Для отладки
    } else {
        // Обработка случая, когда total_cost отсутствует
        echo "Ошибка: Итоговая стоимость заказа не указана.";
        exit;
    }

    // Генерируем дату и время заказа
    $dateOrder = date('Y-m-d H:i:s');

    // Записываем основную информацию о заказе в таблицу orders
    $query = "INSERT INTO orders (id_user, date_order, status, price_all, get_bonuses) VALUES ('$id_user', '$dateOrder', 'New', '{$totalCost}', 1)";
    if (mysqli_query($con, $query)) {
        // Получаем ID последнего добавленного заказа
        $lastOrderId = mysqli_insert_id($con);

        // Обновляем содержимое корзины в таблице cart, указывая ID последнего заказа
        $updatedCartContent = json_encode(['id_order' => $lastOrderId]);
        $query = "UPDATE cart SET content_shopcart = '$updatedCartContent' WHERE id_shopcart = 16"; // Предполагается, что ID корзины равен 16
        if (mysqli_query($con, $query)) {
            // Обновляем количество бонусных баллов пользователя
            $updateBonusQuery = "UPDATE users SET bonus_balls = bonus_balls + 1 WHERE id_user = $id_user";
            if (mysqli_query($con, $updateBonusQuery)) {
                // Формирование тела письма
                $subject = "Ваш заказ на сайте BarShik успешно оформлен";
                $message = "Ваш заказ:\n\n";
                foreach ($orderContent as $itemId => $quantity) {
                    $product = get_product_by_id($itemId); // Предполагается, что функция get_product_by_id() получает информацию о товаре по его ID
                    $message .= "{$product['name']} - {$quantity} шт., общая стоимость: {$product['price']} ₽\n";
                }
                $message .= "\nИтоговая сумма: {$totalCost} ₽";

                // Перед отправкой письма
                echo "Message body:<br>" . htmlspecialchars($message) . "<br>"; // Для отладки

                // Отправка письма
                $headers = "From: BarShik Support <support@barshik.com>\r\n";
                $headers .= "Reply-To: support@barshik.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
                mail($userEmail, $subject, $message, $headers);

                echo "<script>alert('Спасибо за ваш заказ. Мы свяжемся с вами скоро.');location.href='user_profile/user.php';</script>";
            } else {
                echo "Ошибка при обновлении количества бонусных баллов пользователя.";
            }
        } else {
            echo "Ошибка при обновлении корзины.";
        }
    } else {
        echo "Ошибка при добавлении заказа.";
    }
} else {
    echo "Только метод POST поддерживается.";
}
