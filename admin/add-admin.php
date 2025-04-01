<?php
include ('partials/menu.php');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Добавить Админа</h1>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Имя: </td>
                        <td>
                            <input type="text" name="full_name" placeholder="Введите имя">
                        </td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" placeholder="Введите username">
                        </td>
                    </tr>
                    <tr>
                        <td>Пароль: </td>
                        <td>
                            <input type="password" name="password" placeholder="Введите пароль">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Добавить" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php include ('partials/footer.php')?>

<?php
    if (isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "INSERT INTO admins SET full_name = '$full_name', username='$username', password='$password'";

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if ($res == TRUE) {
            $_SESSION['add'] = "Админ успешно добавлен";
            header('location: '. SITEURL . '/admin/manage-admin.php');
        } else {
            $_SESSION['add'] = "Ошибка!!!";
            header('location: '. SITEURL . '/admin/add-admin.php');
        }
        }
