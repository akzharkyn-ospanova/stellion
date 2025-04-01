<?php include ('partials/menu.php'); ?>

<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM products WHERE id=$id";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);

            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];

        } else {
            header('location:' . SITEURL . '/admin/manage-product.php');
        }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Редактирование товара</h1>

        <br><br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Название: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        Описание:
                    </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="10"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Цена: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Текущее изображение: </td>
                    <td>
                        <?php

                        $image_path = $_SERVER['DOCUMENT_ROOT'] . "/images/product/" . $current_image;

                        if (file_exists($image_path)) {
                            echo '<img src="' . SITEURL . '/images/product/' . $current_image . '" class="product-image" alt="" width="150">';
                        } else {
                            echo "<div class='error'>Не доступно</div>";
                        }

                        ?>
                    </td>
                </tr>


                <tr>
                    <td>Новое изображение: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Категория: </td>
                    <td>
                        <select name="category" id="">

                            <?php
                                $sql = "SELECT * FROM categories WHERE active = 'Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        ?>
                                        <option <?php if ($current_category == $category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                } else {
                                    echo "<option value='0'>Нет категориев</option>";
                                }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" required> Да
                        <input <?php if ($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No" required> Нет
                    </td>
                </tr>

                <tr>
                    <td>Активный: </td>
                    <td>
                        <input <?php if ($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes" required> Да
                        <input <?php if ($active=="No"){echo "checked";} ?>  type="radio" name="active" value="No"required> Нет
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Сохранить" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if(isset($_FILES['image']['name'])){

                $image_name = $_FILES['image']['name'];

                if($image_name != ""){
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_name = "product_" . rand(000, 999) . "." . $ext;
                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/product/" . $image_name;
                    $upload = move_uploaded_file($src_path, $dest_path);

                    if ($upload == false) {

                        $_SESSION['upload'] = "<div class='error'>Ошибка!!!</div>";
                        header('location:' . SITEURL . '/admin/manage-product.php');

                        die();
                    }

                    if ($current_image != "") {
                        $remove_path = "../images/product/" . $current_image;
                        $remove = unlink($remove_path);

                        if ($remove == false) {
                            $_SESSION['filed-remove'] = "<div class='error'>Ошибка!!!</div>";
                            header('location:' . SITEURL . '/admin/manage-product.php');
                            die();
                        }
                    }
                }
            }

            else {
                $image_name = $current_image;
            }

            $sql3 = "UPDATE products SET
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                where id=$id";

            $res3 = mysqli_query($conn, $sql3);
            if ($res3) {

                $_SESSION['update'] = "<div class='success'>Успешно сохранено!</div>";
                header('location:' . SITEURL . '/admin/manage-product.php');
            } else {

                $_SESSION['update'] = "<div class='error'>Ошибка!!!</div>";
                header('location:' . SITEURL . '/admin/manage-product.php');
            }
        }
        ?>

    </div>

</div>

<?php include ('partials/footer.php'); ?>
