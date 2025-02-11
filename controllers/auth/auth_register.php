<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../../inc/nav.php';
include "../../database/database.php";
if (isset($_GET['page']) && $_GET['page'] === 'auth_register') {
    die("Page detected: auth_register");
}
echo " before Form submitted!";
exit;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "request method" . $_SERVER['REQUEST_METHOD'];
    print_r($_POST);
    exit;

    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $phone = trim(htmlspecialchars($_POST['phone']));
    $phone = intval($phone);
    $password = trim(htmlspecialchars($_POST['password']));

    if (empty($name) || empty($email) || empty($password) || empty($phone)) {
        echo " 1 Form submitted!";
        exit;
        $_SESSION['errors'] = "All fields are required";
        header("Location:index.php?page=register");
        exit;
    }

    if (strlen($name) < 6 || strlen($name) > 15) {
        echo "2 Form submitted!";
        exit;
        $_SESSION['errors'] = "Name must be between 6 and 15 characters";
        header("Location:index.php?page=register");
        exit;
    }

    if (!$email) {
        echo " 3 Form submitted!";
        exit;
        $_SESSION['errors'] = "Please enter a valid email";
        header("Location:index.php?page=register");
        exit;
    }

    if (!$phone) {
        echo " 4 Form submitted!";
        exit;
        $_SESSION['errors'] = "Please enter a valid phone number";
        header("Location:index.php?page=register");
        exit;
    }

    if (strlen($password) < 6 || strlen($password) > 15) {
        echo " 5 Form submitted!";
        exit;
        $_SESSION['errors'] = "Password must be between 6 and 15 characters";
        header("Location:index.php?page=register");
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (`name`, `email`, `phone`, `password`) 
            VALUES ('$name', '$email', '$phone', '$password_hash')";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo " 6 Form submitted!";
        exit;
        $_SESSION['username'] = $name;
        header("Location:index.php?page=home");
        exit;
    } else {
        echo " 7 Form submitted!";
        exit;
        $_SESSION['errors'] = "Failed to register: " . mysqli_error($conn);
        header("Location:index.php?page=register");
        exit;
    }
} else {
    echo " 8 Form submitted!";
    exit;
    $_SESSION['errors'] = "Invalid request";
    header("Location:index.php?page=register");
    exit;
}
