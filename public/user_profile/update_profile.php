<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}



$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

if (isset($_SESSION['user_id']) && isset($_POST['email'], $_POST['cash_password'])) {

    $email = $_POST['email'];
    $password = $_POST['cash_password']; // Хеширование пароля
    $userId = $_SESSION['user_id'];

    $sql = "SELECT * FROM `users` WHERE email = '$email' AND id_user != '$userId'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Эта почта уже занята!'); location.href='user.php'</script>";
    } else {
        $sql = "UPDATE users SET email = '$email', cash_password = '$password' WHERE id_user = '$userId'";

        if ($con->query($sql) === TRUE) {
            echo "<script>alert('Данные обновлены успешно!');location.href='user.php';</script>";
            exit();
        }
    }
} else {
    echo "Ошибка: данные не получены.";
}

$con->close();
