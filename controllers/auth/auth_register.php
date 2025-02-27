<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $phone = trim(htmlspecialchars($_POST['phone']));
    $phone = intval($phone);
    $password = trim(htmlspecialchars($_POST['password']));

    if (empty($name) || empty($email) || empty($password) || empty($phone)) {
        $_SESSION['errors'] = "All fields are required";
        header("Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (strlen($name) < 6 || strlen($name) > 15) {
        $_SESSION['errors'] = "Name must be between 6 and 15 characters";
        header("Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (!$email) {
        $_SESSION['errors'] = "Please enter a valid email";
        header("Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (!$phone) {
        $_SESSION['errors'] = "Please enter a valid phone number";
        header("Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (strlen($password) < 6 || strlen($password) > 15) {
        $_SESSION['errors'] = "Password must be between 6 and 15 characters";
        header("Location:index.php?page=register");
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    
    $role = 'user'; 

    $sql = "INSERT INTO users (name, email, phone, password, role) 
            VALUES ('$name', '$email', '$phone', '$password_hash', '$role')";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        $_SESSION['username'] = $name;
        $_SESSION['role'] = $role;
        
        
        if ($role === 'admin') {
            header("Location: index.php?page=admin_dashboard");
        } else {
            header("Location: index.php?page=home");
        }
        exit;
    } else {
        $_SESSION['errors'] = "Failed to register: " . mysqli_error($conn);
        header("Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }
} else {
    $_SESSION['errors'] = "Invalid request";
    header("Location:" . $_SERVER['HTTP_REFERER']);
    exit;
}
?>