<?php
require_once 'database.php' ;

if(isset($_GET['id'])){

    $id = $_GET['id'] ;

    $sql = "DELETE FROM `posts` WHERE id=$id" ;
    $query = mysqli_query($conn , $sql) ;
    
    header("location: " . $_SERVER['HTTP_REFERER']);
}

















?>