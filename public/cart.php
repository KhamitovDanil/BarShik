<? session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Корзина</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php require_once('nav.php'); ?>

    <div class="shopping-cart">
        <?php
        require_once 'functions.php';

        $con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");
        $id_user = $_SESSION["user_id"];

        $cartResult = mysqli_query($con, "SELECT content_shopcart FROM cart WHERE id_user = '$id_user'");
        $cartRow = mysqli_fetch_assoc($cartResult);

        if ($cartRow && !is_null($cartRow["content_shopcart"])) {
            $cart = (array) json_decode($cartRow["content_shopcart"], true);

            $totalCost = 0;
            foreach ($cart as $itemId => $quantity) {
                $product = get_product_by_id($itemId);
                $totalPrice = $product['price'] * $quantity;
                $totalCost += $totalPrice;
            }

            echo "<table class='cart-table'>";
            echo "<thead><tr><th>Название</th><th>Количество</th><th>Общая стоимость</th></tr></thead><tbody>";
            foreach ($cart as $itemId => $quantity) {
                $product = get_product_by_id($itemId);
                $totalPrice = $product['price'] * $quantity;
                echo "<tr>";
                echo "<td>{$product['name']}</td>";
                echo "<td>{$quantity} шт.</td>";
                echo "<td>{$totalPrice} ₽</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";

            echo "<h2>Итоговая сумма: {$totalCost} ₽</h2>";
            echo "<form method='post' action='process_order.php'>";
            echo "<input type='hidden' name='order_content' value='" . json_encode($cart) . "'>";
            echo "<input type='hidden' name='total_cost' value='{$totalCost}'>";
            echo "<button type='submit' class='btn btn-dark'>Оформить заказ</button>";
            echo "</form>";
        } else {
            echo "<p>Корзина пуста.</p>";
        }
        ?>
    </div>
</body>


</html>

<style>
    body {
        background: linear-gradient(360deg, rgba(2, 0, 36, 1) 0%, rgba(24, 83, 93, 1) 17%, rgba(47, 170, 153, 1) 100%);
        background-repeat: no-repeat;
        color: white;
        height: 100vh;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
    }

    .orders-table th,
    .orders-table td {
        padding: 15px;
        text-align: left;
        border: 1px solid aquamarine;
    }

    .orders-table tr:nth-child(even) {
        background-color: black;
    }

    .orders-table th {
        background-color: black;
        color: white;
    }


    .shopping-cart {
        max-width: 800px;
        margin: auto;
        padding: 20px;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-table th,
    .cart-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid aquamarine;

    }

    .cart-table tr:nth-child(even) {
        background-color: black;
    }

    .cart-table th {
        background-color: black;
        color: white;
    }

    .btn-dark {
        display: inline-block;
        font-weight: bolder;
        color: lightseagreen;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        background-color: black;
        border: 1px solid transparent;
        padding: .375rem.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color.15s ease-in-out, background-color.15s ease-in-out, border-color.15s ease-in-out, box-shadow.15s ease-in-out;
    }

    .btn-dark:hover {
        background-color: black;
        color: aqua;
    }
</style>