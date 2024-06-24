<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once "nav.php"; ?>

    <div class="container">
        <h1>Добавление товара</h1>
        <form action="/db/add_item.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Введите название:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Введите описание:</label>
                <input type="text" class="form-control" id="desc" name="desc">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Введите стоимость:</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Добавьте фото</label>
                <input type="file" class="form-control" id="img" name="img">
            </div>
            <?php
            // Код для вывода выпадающего списка категорий
            $con = mysqli_connect("mysql-8.2", "root", "", "BarShik2");

            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            $sql = "SELECT category_id, name_category FROM categories ";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo '<select name="cat_id" class="form-select">';
                echo "<option value = '' selected disabled>Выберите категорию товара:</option>";

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["category_id"] . "'>" . $row["name_category"] . "</option>";
                }
                echo '</select>';
            } else {
                echo "No categories found.";
            }
            $con->close();
            ?>
            <button type="submit" class="btn btn-primary mb-3">Добавить товар</button>
        </form>
    </div>
</body>

</html>