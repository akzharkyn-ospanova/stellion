<?php
include ($_SERVER['DOCUMENT_ROOT'].'/config/constants.php');
include ('login-check.php');
?>

<html lang="">
<head>
    <title>Панель управления</title>
    <link rel="stylesheet" href="/css/admina.css">
</head>
<body>
<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li><a href="index.php">Главная страница</a></li>
            <li><a href="manage-admin.php">Админ</a></li>
            <li><a href="manage-category.php">Категории</a></li>
            <li><a href="manage-product.php">Товары</a></li>
            <li><a href="view-requests.php">Заказы</a></li>
            <li><a href="logout.php">Выйти</a></li>
        </ul>
    </div>
</div>