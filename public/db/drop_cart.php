<?php
session_start();

$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

$id_item = $_GET["id"];

$id_user = $_SESSION["user_id"];

$cart = (array) json_decode(
    mysqli_fetch_assoc(
        mysqli_query($con, "select content_shopcart from cart where id_user = '$id_user'")
    )["content_shopcart"]
);


if (--$cart[$id_item] == 0) { //проверка на удаление товара
    unset($cart[$id_item]);
}

if (count($cart)) {
    $sql = "DELETE FROM `cart` WHERE id_user = '$id_user'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        unset($_SESSION["cart"]);
        header("Location: /");
    }
}

$compound = json_encode($cart);

$sql = "UPDATE `cart` SET `content_shopcart` = '$compound' where id_user = '$id_user'";

$result = mysqli_query($con, $sql);

if ($result) {
    $_SESSION["cart"] = $compound;
    header("Location: /");
}
