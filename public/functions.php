<?php
function get_product_by_id($id)
{
    global $con; // Использование глобального объекта соединения
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Возвращаем первую строку результата как ассоциативный массив
        return mysqli_fetch_assoc($result);
    } else {
        // Возвращаем null, если продукт не найден
        return null;
    }
}
