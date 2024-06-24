<? session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет пользователя</title>

</head>

<body>

    <?php require_once('../nav.php'); ?>

    <center>
        <div id="edit" class="container mb-4">
            <h1 style="color: black;font-weight:900">Мои данные</h1>
            <?php

            $con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");


            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $sql = "SELECT * FROM users WHERE id_user = '$userId'";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc(); ?>
                    <form action="update_profile.php" method="post">
                        <div id="form-contents">
                            <div class="mb-3">
                                <label for="email" class="form-label">Почта:</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль:</label>
                                <input type="text" class="form-control" id="password" name="cash_password" value="<?php echo $user['cash_password']; ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark">Сохранить изменения</button>
                    </form>
            <?php
                } else {
                    echo "Пользователь не найден.";
                }
            } else {
                header("Location: ../signIn.php");
                exit();
            }
            ?>
        </div>


        <div id="orders" class="container mb-3">
            <h1>Мои Заказы</h1>
            <?php
            $con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

            $userId = $_SESSION['user_id'];
            $sql = "SELECT * FROM orders WHERE id_user = '$userId'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='orders-table table-striped'>";
                echo "<thead><tr><th scope='col'>ID Заказа</th><th scope='col'>Дата и время</th><th scope='col'>Статус</th><th scope='col'>Общая стоимость</th><th scope='col'>Использовано бонусов</th><th scope='col'>Получено бонусов</th></tr></thead><tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id_order']}</td>";
                    echo "<td>{$row['date_order']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td>{$row['price_all']}</td>";
                    echo "<td>{$row['used_bonuses']}</td>";
                    echo "<td>{$row['get_bonuses']}</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>Заказов нет.</p>";
            }
            ?>
        </div>
        <?
        $sql = "SELECT * FROM users WHERE id_user = '$userId'";
        $result = $con->query($sql);
        $row = mysqli_fetch_assoc($result);

        if ($result->num_rows > 0) { ?>
            <h3>Ваши бонусы: <? echo "{$row['bonus_balls']}" ?></h3>

        <? } ?>

    </center>

    <style>
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

        body {
            background: linear-gradient(360deg, rgba(2, 0, 36, 1) 0%, rgba(24, 83, 93, 1) 17%, rgba(47, 170, 153, 1) 100%);
            background-repeat: no-repeat;
            color: white;
            height: 100vh;
        }
    </style>





</body>

</html>