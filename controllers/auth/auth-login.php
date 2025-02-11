<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_SESSION['username'])){
        header("location:index.php");
        exit;
    }
    $email = trim(htmlspecialchars(htmlentities(($_POST['email']))));
    $password = trim(htmlspecialchars(htmlentities($_POST['password'])));

    if(empty($email) || empty($password)){
        $_SESSION['errors'] = "this field is required" ;
        header("location" . $_SERVER['HTTP_REFERER']) ;
        exit ;
    }

    $sql = "SELECT * FROM `users` WHERE email='$email'" ;
    $query = mysqli_query($conn , $sql) ;

    $user = mysqli_fetch_assoc($query);
     var_dump($user);

    if(password_verify($password,$user['password'])){
     $_SESSION['success'] = $user['name'] ;
     header("location:index.php");
     exit;

    }else{
        $_SESSION['errors'] = "failed to login " ;
        header("location:" .$_SERVER['HTTP_REFERER']);
        exit ;
    }
}










?>