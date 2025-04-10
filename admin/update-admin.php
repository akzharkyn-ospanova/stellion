<?php
include ('partials/menu.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM admins WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        echo "Ошибка MySQL: " . mysqli_error($conn);
    }


    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $full_name = $row['full_name'];
            $username = $row['username'];
        } else {
            header('location:'.SITEURL.'/admin/manage-admin.php');
            exit();
        }
    }
} else {
    header('location:'.SITEURL.'/admin/manage-admin.php');
    exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Редактирование админа</h1>
        <br><br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Имя:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Сохранить" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE admins SET full_name='$full_name', username='$username' WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['update'] = "<div class='success'>Успешно изменено!</div>";
    } else {
        $_SESSION['update'] = "<div class='error'>Ошибка!!!</div>";
    }

    header('location:'.SITEURL.'/admin/manage-admin.php');
    exit();
}

include ('partials/footer.php');
?>
