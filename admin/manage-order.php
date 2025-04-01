<?php
include('../config/constants.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "INSERT INTO contact_requests (first_name, last_name, phone) VALUES ('$first_name', '$last_name', '$phone')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../index.php?message=success");
        exit();
    } else {
        echo "Ошибка: " . mysqli_error($conn);
    }
}

