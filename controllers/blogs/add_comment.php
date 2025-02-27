<?php
require_once 'config/db_connection.php';


if (!isset($_SESSION['username'])) {
    $_SESSION['errors'] = "You must be logged in to comment.";
    header("location: index.php?page=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = intval($_POST['post_id']);
    $comment = trim(htmlspecialchars($_POST['comment']));
    $user_id = $_SESSION['user_id'];

    if (empty($comment)) {
        $_SESSION['errors'] = "Comment cannot be empty.";
        header("location: index.php?page=post&id=$post_id");
        exit;
    }

    $sql = "INSERT INTO comments (post_id, user_id, comment, created_at) VALUES ('$post_id', '$user_id', '$comment', NOW())";

    try {
        $query = mysqli_query($conn, $sql);
        if (!$query) {
            $_SESSION['errors'] = "Error: " . mysqli_error($conn);
            header("location: index.php?page=post&id=$post_id");
            exit;
        }
        $_SESSION['success'] = "Comment added successfully!";
        header("location: index.php?page=post&id=$post_id");
        exit;
    } catch (Exception $ex) {
        $_SESSION['errors'] = "Exception: " . $ex->getMessage();
        header("location: index.php?page=post&id=$post_id");
        exit;
    }
} else {
    header("location: index.php");
    exit;
}