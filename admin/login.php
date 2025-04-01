<?php include('../config/constants.php');

session_start();
?>


<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../css/admina.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Войти</h1>
            <br><br>

            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>

            <br><br>

            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Введите username"><br><br>
                Пароль: <br>
                <input type="password" name="password" placeholder="Введите пароль"><br><br>

                <input type="submit" name="submit" value="Войти" class="btn-primary">
                <br><br>
            </form>

            <p class="text-center">`Stellion</p>
        </div>

    </body>

</html>

<?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $_SESSION['login'] = "<div class = 'success'> Успешно! </div>";
            $_SESSION['user'] = $username;
            header('location: ' .SITEURL. '/admin/index.php');
        } else {
            $_SESSION['login'] = "<div class = 'error'> Пароль или логин неверный!!! </div>";
            header('location: ' .SITEURL. '/admin/login.php');
        }
    }
?>
