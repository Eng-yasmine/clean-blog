<?php
require_once '../../config/db_connection.php';
require_once '../../database/database.php';

if(!isset($_SESSION['username'])){
    header("location:index.php?page=login");
    exit;
}

$update_blog = "";
if(isset($_GET['id'])){
    $id = intval($_GET['id']) ;
    $sql ="SELECT * FROM `posts` WHERE id='$id'";
    try {
        $query = mysqli_query($conn, $sql);
        if (!$query) {
            $_SESSION['errors'] = "query not excuted" . mysqli_error($conn);
            header("location:" . $_SERVER['PHP_SELF']);
            exit;
        }
    } catch (Exception $ex) {

        header("location:" . $_SERVER['PHP_SELF']);
        exit;
    }

    $update_blog = mysqli_fetch_assoc($query);
    var_dump($update_blog);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim(htmlspecialchars(htmlentities($_POST['title'])));
    $content = trim(htmlspecialchars(htmlentities($_POST['content'])));
    $user_id =$_SESSION['user_id'];

    if (empty($title) || empty($content)) {
        $_SESSION['errors'] = "this field is required";
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (strlen($title) < 3 || strlen($title) > 25) {

        $_SESSION['errors'] = "sorry ! this title must be between 3 and 25 charcter";
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (strlen($content) < 15 || strlen($content) > 50) {
        $_SESSION['errors'] = "sorry ! this content must be between 15 and 50 charcter";
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $image_name = "";
    if(!empty($_FILES['image']['name'])){
        $image_name = time(). "_" . basename($_FILES['image']['name']);
        $target_dir = "/assets/uploads/"; 
        $target_file = $target_dir .$image_name ;

        if(move_uploaded_file($_FILES['image']['tmp_name'] , $target_file)){ ;
        $_SESSION['success'] = "image uploaded" ;
        exit;
        }else{
            $_SESSION['errors'] = " failed uploaded " ;
            exit;
        }
    }
    //update data if is set id 

    if(isset($_GET['id'])){
        $sql = "UPDATE posts SET title='$title' , content='$content' WHERE id='$id'";
        try {

            $query = mysqli_query($conn, $sql);
            if (!$query) {
                $_SESSION['errors'] = "query not excuted" . mysqli_error($conn);
                header("location:" . $_SERVER['PHP_SELF']);
                exit;
            }
        } catch (Exception $ex) {
    
            header("location:" . $_SERVER['PHP_SELF']);
            exit;
        }
    }else{
    //insert data to table posts
    $sql = "INSERT INTO `posts`(user_id,title,content,created_at,image) 
    VALUES ('$user_id','$title','$content','NOW()','$image_name')";
    try {

        $query = mysqli_query($conn, $sql);
        if (!$query) {
            $_SESSION['errors'] = "query not excuted" . mysqli_error($conn);
            header("location:" . $_SERVER['PHP_SELF']);
            exit;
        }
    } catch (Exception $ex) {

        header("location:" . $_SERVER['PHP_SELF']);
        exit;
    }

    if($query){
        header("location:index.php?page=profile");
        exit;
    }
    }

} else {
    $_SESSION['errors'] = "warning ! please type invalide data";
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit;
}



?>
