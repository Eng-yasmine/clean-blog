<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
 require_once '../../config/db_connection.php';

echo "hello in update page";

if(!isset($_SESSION['username'])){
    header("location:index.php");

}
 $update_blog = "";
 if(isset($_GET['id'])){
 $id = intval($_GET['id']);

 $sql = "SELECT * FROM `posts` WHERE id='$id'";
try{
    $query = mysqli_query($conn , $sql);
    if(!$query){
        $_SESSION['errors'] = "connection failed" . mysqli_connect_error($conn);
        header("location:". $_SERVER['HTTP_REFERER']);
        exit;
    }
}catch(Exception $ex){
    header("location:". $_SERVER['HTTP_REFERER']);
    exit;
}

$update_blog =mysqli_fetch_assoc($query);
// var_dump($update_blog);
header("location:".$_SERVER['HTTP_REFERER']);
exit;

 }












?>