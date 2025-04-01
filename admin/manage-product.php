<?php include ('partials/menu.php')?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Панель управления товарами</h1>

            <br><br><br>

            <a href="<?php echo SITEURL; ?>/admin/add-product.php" class="btn-primary">Добавить</a>

            <br><br><br>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if (isset($_SESSION['unauthorize'])) {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            ?>

            <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Изображение</th>
                    <th>Featured</th>
                    <th>Активный</th>
                    <th>Действия</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM products";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);


                    $n = 1;
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>

                            <tr>
                                <td><?php echo $n++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>$<?php echo $price; ?></td>
                                <td>
                                    <?php
                                    if ($image_name != "") {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>/images/product/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" width="100px">
                                        <?php
                                    } else {
                                        echo "<div class='error'>Ошибка!!!</div>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>/admin/update-product.php?id=<?php echo $id; ?>" class="btn-secondary">Изменить</a>
                                    <a href="<?php echo SITEURL; ?>/admin/delete-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Удалить</a>

                                </td>

                            </tr>

                                <?php
                        }
                    } else {
                        echo "<tr> <td colspan='7' class='error'> Товар не найден!</td> </tr>";
                    }
                    ?>

            </table>
        </div>
    </div>

<?php include ('partials/footer.php')?>