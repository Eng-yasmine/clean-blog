<?php
if(session_status() === PHP_SESSION_NONE)session_start();


try{

    $conn = mysqli_connect("localhost" , "root" ,"" ,"blogs");
    if(!$conn){
        header("location:maintainence.php");
        exit ;
    }
} catch(Exception $ex){
    header("location:maintainence.php");
        exit ;

}





?>