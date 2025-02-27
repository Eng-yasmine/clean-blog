<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));


    if (empty($email) || empty($password)) {
        $_SESSION['errors'] = "Email and Password are required!";
        header("Location: index.php?page=login");
        exit;
    }

    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    if (!$query || mysqli_num_rows($query) == 0) {
        $_SESSION['errors'] = "Invalid email or password!";
        header("Location: index.php?page=login");
        exit;
    }

    $user = mysqli_fetch_assoc($query);
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['name'];
        $_SESSION['role'] = $user['role'];


        if ($user['role'] === 'admin') {
            header("Location: index.php?page=admin_dashboard");
        } else {
            header("Location: index.php?page=home");
        }
        exit;
    } else {
        $_SESSION['errors'] = "Invalid email or password!";
        header("Location: index.php?page=login");
        exit;
    }
} else {
    $_SESSION['errors'] = "Invalid request!";
    header("Location: index.php?page=login");
    exit;
}
