<?php
    include ('../config/constants.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM admins WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['delete'] = "<div class='success'>Успешно админ добавлен</div>";
        header('location:'.SITEURL.'/admin/manage-admin.php');
    }
    else {
        $_SESSION['delete'] = "<div class='error'>Ошибка!!!</div>";
        header('location:'.SITEURL.'/admin/manage-admin.php');
    }
