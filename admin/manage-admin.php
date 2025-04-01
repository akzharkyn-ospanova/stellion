<?php include ('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Панель управления админами</h1>

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

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <br><br><br>

        <a href="add-admin.php" class="btn-primary">Добавить</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Username</th>
                <th>Действия</th>
            </tr>

            <?php

                $sql = "SELECT * FROM admins";
                $res = mysqli_query($conn, $sql);

                if ( $res ) {
                    $count = mysqli_num_rows($res);
                    $n = 1;
                    if ( $count > 0 ) {
                        while ( $row = mysqli_fetch_assoc($res) ) {
                            $id = $row['id'];
                            $full_name = $row['full_name'];
                            $username = $row['username'];
                            ?>

                            <tr>
                                <td><?php
                                    echo $n++;
                                    ?>
                                </td>
                                <td><?php echo $full_name?></td>
                                <td><?php echo $username?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>/admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Изменить</a>
                                    <a href="<?php echo SITEURL; ?>/admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Удалить</a>
                                </td>
                            </tr>

                            <?php


                        }
                    } else {
                    }
                }
            ?>
        </table>
    </div>
</div>

<?php include ('partials/footer.php')?>