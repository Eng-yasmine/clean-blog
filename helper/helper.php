<?php

function successmessage(){

    if(!empty($_SESSION['success'])){
        echo "<div class='alert alert-success text-center' role='alert'>{$_SESSION['success']}</div>";
        unset($_SESSION['success']);
    }
}



function errormessage(){

    if(!empty($_SESSION['errors'])){
        echo "<div class='alert alert-danger text-center' role='alert'>{$_SESSION['errors']}</div>";
        unset($_SESSION['errors']);
    }
}










?>