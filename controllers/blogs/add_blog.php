<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'helper/session.php';
require_once 'config/db_connection.php';


// var_dump($_POST);
// echo "<pre>";
// var_dump($_FILES);

if (!isset($_SESSION['username'])) {
    header("location:index.php?page=login");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim(htmlspecialchars(htmlentities($_POST['title'])));
    $content = trim(htmlspecialchars(htmlentities($_POST['content'])));

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

    if (strlen($content) < 15 ||  strlen($content) > 50) {
        $_SESSION['errors'] = "sorry ! this content must be between 15 and 50 charcter";
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $image_name = [];

    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        /* var_dump($_FILES); */
        $allowed_image = ['jpg', 'png', 'jpeg', 'gif'];

        $tmp = $_FILES['image']['tmp_name'][0];
        
        $image = $_FILES['image']['name'];

        foreach ($_FILES['image']['name'] as $key =>  $value) {
            $image_name = $_FILES['image']['name'][$key];
            $image_name = explode(".", $image_name)[0];
            // var_dump(explode(".", $image_name));
            $image_ext = $_FILES['image']['type'][$key];
            $image_size = $_FILES['image']['size'][$key];
            $image_ext = strtolower(explode("/", $image_ext)[1]);
            // var_dump($image_ext);

        }

        if (!in_array($image_ext, $allowed_image)) {
            $_SESSION['errors'] = "sorry ! this extention not supported";
            header("locatin:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if ($image_size > 500000) {
            $_SESSION['errors'] = "sorry ! image size too large";
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $time_of_upload = time() . "_" .  $image_name . "." . $image_ext;
        $target_dir = move_uploaded_file($tmp, "assets/img/" .  $time_of_upload);

        $image_name = $time_of_upload;
    }

    $user_id = $_SESSION['user_id'] ?? null;
    //update data if is set id 

    if (isset($_GET['id'])) {
        $sql = "UPDATE posts SET title='$title' , content='$content' , 'image=' $image_name . $image_ext' WHERE id='$id'";
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
    } else {
        //insert data to table posts
        $sql = "INSERT INTO `posts` (user_id,title,content,created_at,image) 
    VALUES ('$user_id','$title','$content',NOW(),'$image_name . $image_ext')";
    var_dump($sql);
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

        if ($query) {
            header("location:".$_SERVER['PHP_SELF']);
            exit;
        }
    }
} else {
    $_SESSION['errors'] = "warning ! please type invalide data";
    header("location:" . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php?page=add_blog'));
    exit;
}
