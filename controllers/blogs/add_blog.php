<?php
require_once '../../config/db_connection.php';
require_once '../../database/database.php';

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

    if (strlen($content) < 15 || strlen($content) > 50) {
        $_SESSION['errors'] = "sorry ! this content must be between 15 and 50 charcter";
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }
    //insert data to table posts
    $sql = "INSERT INTO `posts`(id,user_id,title,content,created_at,image) VALUE ('$id','$user_id','$title','$content','$created_at',$image')";
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
    $_SESSION['errors'] = "warning ! please type invalide data";
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit;
}



?>
<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="" method="POST">
                <h2 class="form-title">Add New Blog Post</h2>
                <div class="form-group mb-3">
                    <label class="form-label">Blog Title</label>
                    <input type="text" name="title" value="<?= isset($update_blog['title']) ? $update_blog['title'] : ""; ?>" class="form-control" placeholder="Enter the post title" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Content</label>
                    <input type="text" name="content" value="<?= isset($update_blog['content']) ? $update_blog['content'] : ""; ?>" class="form-control" placeholder="Enter a short description of the post" required>
                </div>
                <?php if (isset($_GET['id'])) : ?>
                    <button type="submit" class="btn btn-primary">UPDATE Blog</button>
                <?php else : ?>
                    <button type="submit" class="btn btn-primary">Add Blog</button>
                <?php endif; ?>
            </form>

            <h2 class="text-center">Blog Posts</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
                    $query = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['content'] . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>";
                        echo "<a href='?id=" . $row['id'] . "' class='btn btn-success'>UPDATE</a>";
                        echo "<a href='delete_blog.php?id=" . $row['id'] . "' class='btn btn-danger'>DELETE</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
</main>
</body>

</html>
<?php include '../../inc/footer.php'; ?>