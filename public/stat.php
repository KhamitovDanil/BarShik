<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['admin'])) {
    echo '<script>alert("Вы не авторизованы"); location.href = "../signin.php";</script>';
    exit();
}

// Подключение к базе данных
$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

// Запрос к базе данных для получения статистики
$sql = "SELECT COUNT(*) as total_sales, SUM(price_all) as total_cost FROM orders";
$result = mysqli_query($con, $sql);

// Получение результатов
$sales_data = mysqli_fetch_assoc($result);

// Закрытие соединения
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <? require_once "nav.php" ?>

    <center>
        <h2>Статистика</h2>
    </center>
    <div class="container mt-5">
        <h2>Статистика продаж</h2>
        <p>Общее количество продаж: <strong><?php echo htmlspecialchars($sales_data['total_sales']); ?></strong></p>
        <?php
        $totalCost = isset($sales_data['total_cost']) ? $sales_data['total_cost'] : 0; // Устанавливаем 0, если total_cost равен null
        ?>
        <p>Общая сумма продаж: <strong><?php echo htmlspecialchars(number_format($totalCost, 2)); ?></strong> руб.</p>
    </div>

</body>

</html>