<?php
require_once 'database/database.php' ;

if(isset($_GET['id'])){

    $id = intval($_GET['id']) ;

    $sql = "DELETE FROM `posts` WHERE id=$id" ;
    $query = mysqli_query($conn , $sql) ;
    
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

















?>