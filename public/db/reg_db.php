<?php
session_start();
$email = strip_tags(trim($_POST['email'])); // Удаляет все лишнее и записываем значение в переменную //$login 
$pass = strip_tags(trim($_POST['pass']));

$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

$result1 = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
$user1 = mysqli_fetch_assoc($result1); // Конвертируем в массив 

if (empty($email) || empty($pass)) {
    echo "<script>alert('Заполните все поля!'); location.href='../reg.php';</script>";
} else {
    if (!empty($user1)) {
        echo "<script>alert('Данный email уже используется'); location.href='../reg.php';</script>";
        exit();
    } else {
        mysqli_query($con, "INSERT INTO users (`email`, `cash_password`, `bonus_balls`, `role`, `status`) VALUES ('$email', '$pass', '1', 'user', 'активен')");
        echo "<script>alert('Пользователь успешно зарегистрирован Вы можете войти'); location.href='../signin.php';</script>";
    }
}
