<?php

include ('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    $sql = "DELETE FROM products WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['delete'] = "<div class='success'>Успешно товар удален</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Ошибка!!!</div>";
    }

    header('Location: ' . SITEURL . '/admin/manage-product.php');
    exit();
}
