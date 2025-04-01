<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Добавить товар</h1>

        <br><br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Название: </td>
                    <td>
                        <input type="text" name="title" placeholder="Название товара" required>
                    </td>
                </tr>
                <tr>
                    <td>Описание: </td>
                    <td>
                        <textarea name="description" cols="30" rows="10" placeholder="Описание товара" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Цена: </td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>
                <tr>
                    <td>Выбрать изображение: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Категория: </td>
                    <td>
                        <select name="category" required>
                            <?php
                            $sql = "SELECT * FROM categories WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$id'>$title</option>";
                                }
                            } else {
                                echo "<option value='0'>Категория не найдена</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" required> Да
                        <input type="radio" name="featured" value="No" required> Нет
                    </td>
                </tr>
                <tr>
                    <td>Активный: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" required> Да
                        <input type="radio" name="active" value="No" required> Нет
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Добавить" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            $image_name = "";
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "product_" . time() . "." . $ext; // Уникальное имя
                $src = $_FILES['image']['tmp_name'];
                $dst = "../images/product/" . $image_name;

                $upload = move_uploaded_file($src, $dst);
                if (!$upload) {
                    $_SESSION['upload'] = "<div class='error'>Ошибка загрузки изображения!</div>";
                    header('location:' . SITEURL . '/admin/add-product.php');
                    die();
                }
            }

            $sql2 = "INSERT INTO products SET
                    title='$title',
                    description='$description',
                    price='$price',
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2) {
                $_SESSION['add'] = "<div class='success'>Товар успешно добавлен!</div>";
                header('location:' . SITEURL . '/admin/manage-product.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Ошибка при добавлении товара!</div>";
                header('location:' . SITEURL . '/admin/manage-product.php');
            }
        }
        ?>
    </div>
</div>
