<?php
$con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");
session_start();
$items = mysqli_query($con, "SELECT * FROM products");
$cart = [];
if (isset($_SESSION["cart"])) $cart = (array)json_decode($_SESSION["cart"]);
// var_dump($cart);
?>

<?php require_once('nav.php'); ?>
<div class="container">
    <div class="d-flex flex-wrap">
        <?php while ($item = mysqli_fetch_assoc($items)) {
            echo "<div class='card text-center w-25'>";
            echo "<div class='c_img'><img src='images/" . $item['img'] . "'></div>";
            echo "<p>" . $item['name'] . "</p>";
            echo "<p>" . $item['description'] . "</p>";
            echo "<p>" . $item['price'] . "₽</p>";

            if (array_key_exists($item['id'], $cart)) {
                echo "<div>";

                echo "<a href='/db/drop_cart.php?id=" . $item['id'] . "' class='btn btn-primary'>-</a>";

                echo $cart[$item['id']], "шт.";

                echo "<a href='/db/add_cart.php?id=" . $item['id'] . "' class='btn btn-primary'>+</a>";

                echo "</div>";
            } else {
                if (!isset($_SESSION['admin'])) {
                    echo "<a href='/db/add_cart.php?id=" . $item['id'] . "' class='btn btn-primary w-50 m-auto'>В корзину</a>";
                }
            }

            echo "</div>";
        }
        ?>
    </div>

</div>

</body>

</html>
