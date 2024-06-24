<?php
$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

// Проверяем подключение к базе данных
if (!$con) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

$name = $_POST["name"];
$desc = $_POST["desc"];
$cat_id = $_POST["cat_id"];
$price = $_POST["price"];
$img = $_FILES["img"];

if ($img["error"] !== UPLOAD_ERR_OK) {
    die("Ошибка при загрузке файла: " . $img["error"]);
}

$file_name = $img["name"];
// Проверяем, что изображение действительно загружено
if (is_uploaded_file($img["tmp_name"])) {
    // Определяем абсолютный путь к директории для загрузки
    $upload_dir = "../images/";

    // Проверяем, существует ли директория, куда будем загружать файл
    if (!file_exists($upload_dir)) {
        // Создаем директорию, если она не существует
        mkdir($upload_dir, 0777, true);
    }

    // Перемещаем загруженное изображение в директорию images/
    if (move_uploaded_file($img["tmp_name"], "$upload_dir$file_name")) {
        $result = mysqli_query($con, "INSERT INTO `products`( `name`, `description`, `category_id`, `price`, `img`, `status`) VALUES ('$name', '$desc', '$cat_id', '$price', '$file_name', 'активен')");

        if ($result) {
            echo "<script>alert('Товар успешно добавлен!');location.href='../';</script>";
        } else {
            die("Ошибка выполнения запроса: " . mysqli_error($con));
        }
    } else {
        die("Ошибка при перемещении файла.");
    }
} else {
    die("Файл не был загружен.");
}
