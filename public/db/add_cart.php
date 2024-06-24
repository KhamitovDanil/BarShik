<?php
session_start();

$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

$id_item = $_GET["id"];

if(!isset($_SESSION["user_id"])){
    echo "<script>alert('Вы не авторизованы!');location.href='../';</script>";
} 
$id_user = $_SESSION["user_id"];

$cart = mysqli_fetch_assoc(mysqli_query($con, "select content_shopcart from cart where id_user = '$id_user'"));

if (is_null($cart)) {

    $compound[$id_item] = 1;

    $compound = json_encode($compound);

    $sql = "INSERT INTO `cart`(`id_user`, `content_shopcart`) VALUES ($id_user , '$compound')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION["cart"] =
            mysqli_fetch_assoc(mysqli_query($con, "select content_shopcart from cart where id_user = '$id_user'"))['content_shopcart'];
        header("Location: /");
    }
}

$cart = $cart["content_shopcart"]; // string(8) "{"1": 1}" 

$cart = (array) json_decode($cart); //object(stdClass)#2 (1) { ["1"]=> int(1) }


if (array_key_exists($id_item, $cart)) {
    $cart[$id_item]++;
} else {
    $cart[$id_item] = 1;
}

$compound = json_encode($cart);

$sql = "UPDATE `cart` SET `content_shopcart` = '$compound' where id_user = '$id_user'";

$result = mysqli_query($con, $sql);

if ($result) {
    $_SESSION["cart"] = $compound;
    header("Location: /");
}