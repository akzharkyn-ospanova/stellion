<?php include ('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Панель управления категориями</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['filed-remove'])) {
            echo $_SESSION['filed-remove'];
            unset($_SESSION['filed-remove']);
        }
        ?>

        <br><br>

        <a href="<?php echo SITEURL; ?>/admin/add-category.php" class="btn-primary">Добавить</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Изображение</th>
                <th>Описание</th>
                <th>Featured</th>
                <th>Активный</th>
                <th>Действия</th>
            </tr>

            <?php
            $sql = "SELECT * FROM categories";
            $res = mysqli_query($conn, $sql);

            $n = 1;
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $description = $row['description'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $n++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php
                            if ($image_name != "") {
                                ?>
                                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" width="100px">
                                <?php
                            } else {
                                echo "<div class='error'>Ошибка!!!</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>

                        <td>
                            <a href="<?php echo SITEURL; ?>/admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Изменить</a>
                            <a href="<?php echo SITEURL; ?>/admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Удалить</a>

                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5"><div class="error">Ошибка!!!</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<?php include ('partials/footer.php'); ?>
