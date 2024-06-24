<?php

session_start();

$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

$id_item = $_GET["id"];

$id_user = $_SESSION["user_id"];

$cart = mysqli_fetch_assoc(mysqli_query($con, "select content_shopcart from cart where id_user = '$id_user"));

if (is_null($cart)) {

    $compound[$id_item] = 1;

    $compound = json_encode($compound);

    $sql = "INSERT INTO `cart` (`id_user`,`content_shopcart`) VALUES ($id_user, $compound)";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION["cart"] = mysqli_fetch_assoc(mysqli_query($con, "select content_shopcart from `cart` where id_user = '$id_user'"))['compound'];
        header("Location: /");
    }
}

$cart = $cart["content_shopcart"]; //строка string(8) "("1": 1)"

$cart = (array)json_decode($cart); //object(stdClass)#2 (1) { ["1"]=> int(1) }

// var_dump($cart);

if (array_key_exists($id_item, $cart)) {
}
