<?php
include '../../inc/nav.php' ;
include '../../inc/header.php';
require_once '../../database/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $update_blog = mysqli_fetch_assoc($query);
 }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (isset($_GET['id'])) {
        // Update existing post
        $id = $_GET['id'];
        $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
    } else {
        // Insert new post
        $sql = "INSERT INTO posts (title, content, created_at) VALUES ('$title', '$content', NOW())";
    }

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
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