<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Редактирование категории</h1>

        <br><br><br>

        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM categories WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $description = $row['description'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    $_SESSION['no-category-found'] = "<div class='error'>Категория не найдена!</div>";
                    header('location:' . SITEURL . '/admin/manage-category.php');
                }

            } else {
                header('location:' . SITEURL . '/admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Название:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Текущее изображение: </td>
                <td>
                    <?php
                        if ($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image; ?>" width="150px" alt="">

                            <?php
                        } else {
                            echo "<div class='error'>Ошибка!!!</div>";
                        }
                    ?>
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
                <td>Новое изображение: </td>
                <td>
                    <input type="file" name="image">
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
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                        $temp = explode(".", $image_name);
                        $ext = end($temp);
                        $image_name = "category_" . rand(000, 999) . "." . $ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/" . $image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if ($upload == false) {

                            $_SESSION['upload'] = "<div class='error'>Ошибка!!!</div>";
                            header('location:' . SITEURL . '/admin/manage-category.php');

                            die();
                        }

                        if ($current_image != "") {
                            $remove_path = "../images/category/" . $current_image;
                            $remove = unlink($remove_path);
                            if ($remove == false) {
                                $_SESSION['filed-remove'] = "<div class='error'>Ошибка!!!</div>";
                                header('location:' . SITEURL . '/admin/manage-category.php');
                                die();
                            }
                        }
                    } else {
                        $image_name = $current_image;
                    }
                }

                else {
                    $image_name = $current_image;
                }

                $sql2 = "UPDATE categories SET
                    title='$title',
                    description='$description',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id";

                $res2 = mysqli_query($conn, $sql2);

                if ($res2) {
                    $_SESSION['update'] = "<div class='success'>Успешно сохранено!</div>";
                    header('location:' . SITEURL . '/admin/manage-category.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Ошибка!!!</div>";
                    header('location:' . SITEURL . '/admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include ('partials/footer.php'); ?>