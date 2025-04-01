<?php include ('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Добавить категорию</h1>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Название: </td>
                        <td>
                            <input type="text" name="title" placeholder="Название категории">
                        </td>
                    </tr>
                    <tr>
                        <td>Выбрать изображение: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Описание: </td>
                        <td>
                            <input type="text" name="description" placeholder="Описание категории">
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

                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }
                    else {
                        $featured = "No";
                    }

                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }
                    else {
                        $active = "No";
                    }

                    if (isset($_FILES['image']['name'])) {
                        $image_name = $_FILES['image']['name'];
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        $image_name = "category_".rand(000, 999).".".$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>Ошибка!!!</div>";
                            header('location:' . SITEURL . '/admin/add-category.php');

                            die();
                        }
                    }
                    else {
                        $image_name = "";
                    }
                    $sql = "INSERT INTO categories SET title='$title', description='$description', image_name='$image_name', featured='$featured', active='$active'";

                    $res = mysqli_query($conn, $sql);

                    if ($res) {
                        $_SESSION['add'] = "<div class='success'>Успешно категория добавлена</div>";
                        header('location: '.SITEURL.'/admin/manage-category.php');
                    } else {
                        $_SESSION['add'] = "<div class='error'>Ошибка!!!</div>";
                        header('Location: ' . SITEURL . '/admin/add-category.php');
                    }
                    exit();
                }
            ?>
        </div>
    </div>
<?php include ('partials/footer.php')?>
