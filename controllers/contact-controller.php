<?php
//error_reporting(E_ALL);
ini_set('display_errors', 0);
require_once './config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim(htmlspecialchars(htmlentities($_POST['name'])));
    $email = trim(htmlspecialchars(htmlentities($_POST['email'])));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $phone = trim(htmlspecialchars(htmlentities($_POST['phone'])));
    $message = trim(htmlspecialchars(htmlentities($_POST['message'])));
   // var_dump($_POST);

   if (empty($name) || empty($email) || empty($phone) || empty($message) ) {
        
    $_SESSION['errors'] = "All fields are required";
    header("Location:" . $_SERVER['HTTP_REFERER']);
    exit;
}

if (strlen($name) < 6 || strlen($name) > 15) {
   
    $_SESSION['errors'] = "Name must be between 6 and 15 characters";
    header("Location:" . $_SERVER['HTTP_REFERER']);
    exit;
}

if (strlen($message) < 10 || strlen($name) > 30) {
   
    $_SESSION['errors'] = "message must be between 6 and 15 characters";
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
if (!$message) {
    
    $_SESSION['errors'] = "Please enter a valid message";
    header("Location:" . $_SERVER['HTTP_REFERER']);
    exit;
}

    $sql = "INSERT INTO `contacts`(`name`,`email`,`phone`,`message`) VALUES('$name','$email','$phone','$message')";
try{
    $query = mysqli_query($conn, $sql);
    if(!$query){
        $_SESSION['errors'] = "query not excuted" . mysqli_error($conn);
        header("location:index.php?page=contact");
        exit;
    }else{
        $_SESSION['success'] = "success contact" ;
    }
}catch(Exception $ex){
    header("location:index.php?page=contact");
    exit;
}

}
