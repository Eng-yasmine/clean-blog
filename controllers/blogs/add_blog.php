<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'helper/session.php';
require_once 'config/db_connection.php';

if (!isset($_SESSION['username'])) {
    header("location:index.php?page=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim(htmlspecialchars($_POST['title']));
    $content = trim(htmlspecialchars($_POST['content']));

    if (empty($title) || empty($content)) {
        $_SESSION['errors'] = "All fields are required.";
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (strlen($title) < 3 || strlen($title) > 25) {
        $_SESSION['errors'] = "Title must be between 3 and 25 characters.";
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (strlen($content) < 15 || strlen($content) > 50) {
        $_SESSION['errors'] = "Content must be between 15 and 50 characters.";
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $image_name = "";

    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
        $allowed_image = ['jpg', 'png', 'jpeg', 'gif'];

        foreach ($_FILES['image']['name'] as $key => $value) {
            $image_ext = strtolower(pathinfo($value, PATHINFO_EXTENSION));
            $image_size = $_FILES['image']['size'][$key];

            if (!in_array($image_ext, $allowed_image)) {
                $_SESSION['errors'] = "Unsupported image extension.";
                header("location:" . $_SERVER['HTTP_REFERER']);
                exit;
            }

            if ($image_size > 5000000) {
                $_SESSION['errors'] = "Image size too large.";
                header("location:" . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $image_name = time() . "_" . basename($value);
            move_uploaded_file($_FILES['image']['tmp_name'][$key], "assets/img/" . $image_name);
        }
    }

    $user_id = $_SESSION['user_id'] ?? null;
    
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $sql = "UPDATE posts SET title='$title', content='$content', image='$image_name' WHERE id='$id'";
    } else {
        $image_name = !empty($image_name) ? "'$image_name'" : "NULL";
        $sql = "INSERT INTO posts (user_id, title, content, created_at, image) 
                VALUES ('$user_id', '$title', '$content', NOW(), $image_name)";
    }

    try {
        $query = mysqli_query($conn, $sql);
        if (!$query) {
            $_SESSION['errors'] = "Query failed: " . mysqli_error($conn);
            header("location:" . $_SERVER['PHP_SELF']);
            exit;
        }

        $_SESSION['success'] = isset($_GET['id']) ? "Post updated successfully." : "Post added successfully.";
        header("location: index.php?page=profile");
        exit;

    }catch(Exception $ex) {
        $_SESSION['errors'] = "Something went wrong.";
        header("location:" . $_SERVER['PHP_SELF']);
        exit;
    }
}