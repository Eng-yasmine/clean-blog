<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config/db_connection.php';

if (!isset($_SESSION['username'])) {
    header("location:index.php?page=login");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM posts WHERE id='$id'";

    try {
        $query = mysqli_query($conn, $sql);
        if (!$query) {
            $_SESSION['errors'] = "Query failed: " . mysqli_error($conn);
            header("location: index.php?page=profile");
            exit;
        }

        $update_blog = mysqli_fetch_assoc($query);
    } catch (Exception $ex) {
        $_SESSION['errors'] = "Something went wrong.";
        header("location: index.php?page=profile");
        exit;
    }
} else {
    $_SESSION['errors'] = "Invalid request.";
    header("location: index.php?page=profile");
    exit;
}
?>

<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h2>Edit Post</h2>
            <form action="index.php?page=add-blog&id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($update_blog['title']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control" required><?php echo htmlspecialchars($update_blog['content']); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Image</label>
                    <input type="file" name="image[]" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</main>









?>