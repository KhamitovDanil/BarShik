<?php
session_start();
$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

$username = isset($_SESSION["user_id"]) ? mysqli_fetch_assoc(mysqli_query($con, 'select email from users where id_user=' . $_SESSION["user_id"]))["email"] : false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav>
        <div class="profile">
            <nav class="container d-flex justify-content-end">

                <?php if ($username) { ?>
                    <li><a href="user_profile/user.php">
                            <?= $username ?>
                        </a></li>
                <?php } ?>

                <? if (!isset($_SESSION['admin'])) { ?>
                    <li><a href='/sign<?= (!$username) ? "in" : "out" ?>.php' class="d-flex align-items-center">
                            <span style="margin-left:5px;">
                                <?= (!$username) ? "Вход" : "Выход" ?>
                            </span> </a>
                    </li>
                <? } ?>
                <?
                if (isset($_SESSION)) {
                    if (isset($_SESSION["user_id"])) { ?>
                        <li><a href="../cart.php">Корзина</a></li>
                    <? } else if (isset($_SESSION['admin'])) { ?>
                        <li><a href="../admin.php">Добавить товар</a></li>
                        <li><a href="../stat.php">Статистика</a></li>
                        <li><a href="../signout.php">Выход</a></li>

                    <? } ?>

                <? } ?>
                <li><a href="../">Главная</a></li>

            </nav>
        </div>
        <div class="n_title">
            <div class="container d-flex justify-content-center">
                <h1 class="title"><a href="/">BarShik</a> </h1>

            </div>
        </div>
        </div>
    </nav>