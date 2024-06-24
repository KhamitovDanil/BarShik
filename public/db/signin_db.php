<?php
session_start();
$email = strip_tags(trim($_POST['email']));
$pass = strip_tags(trim($_POST['password']));

if (empty($email) || empty($pass)) {
    echo "<script>alert('Заполните все поля!'); location.href='../signin.php';</script>";
} else {

    $con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

    $result = mysqli_query($con, "SELECT * FROM users WHERE `email`='$email' and `cash_password` = '$pass'");

    $res = mysqli_fetch_assoc($result);

    // Проверяем, был ли найден пользователь
    if ($res === NULL) {
        echo "<script>alert('Такой пользователь не найден.'); location.href='../signin.php';</script>";
        exit();
    } else {
        // Здесь $res уже является массивом, поэтому $res['role'] верно

        if ($res['role'] == 'user') {
            $_SESSION["user_id"] = $res["id_user"]; // Исправлено здесь
            $_SESSION["user_email"] = $res["email"]; // Исправлено здесь
            echo "<script>alert('Вы вошли как пользователь'); location.href='../user_profile/user.php';</script>";
        } else if ($res['role'] == 'admin') {
            $_SESSION["admin"] = $res["id_user"]; // Исправлено здесь
            echo "<script>alert('Вы вошли как администратор'); location.href='../admin.php';</script>";
        }
    }
}
