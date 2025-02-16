<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../../config/db_connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    if (isset($_SESSION['username'])) {
        header("location:index.php");
        exit;
    }

    $email = trim(htmlspecialchars(htmlentities($_POST['email'])));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $password = trim(htmlspecialchars(htmlentities($_POST['password'])));

    if (empty($email) || empty($password)) {
        $_SESSION['errors'] = "this field is required" . $_SERVER['HTTP_PREFERE'];
        exit;
    }

    $sql = "SELECT * FROM `users` WHERE email= '$email'";
    $query = mysqli_query($conn , $sql) ;

    $user = mysqli_fetch_assoc($query);
    var_dump($user) ;

    if(password_verify($password,$user['password'])){

        $_SESSION['success'] = $user['name'] ;
        header("location:index.php");
        exit ;
    }
}else{
    $_SESSION['errors'] = "failed to login" ;
    header("Location:" . $_SERVER['HTTP_REFERER']);

    exit;
}




?>