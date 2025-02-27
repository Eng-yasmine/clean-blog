<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config/db_connection.php';

if (!isset($_SESSION['username'])) {
    header("location:index.php?page=login");
    exit;
}
?>

<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h2 class="form-title"><?php echo "Welcome, " . $_SESSION['username'] . " to your profile"; ?></h2>
            
            <?php if (isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['errors']; unset($_SESSION['errors']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
                    $query = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['content']) . "</td>";
                        echo "<td><img src='assets/img/" . $row['image'] . "' width='100'></td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>";
                        echo "<a href='index.php?page=update_blog&id=" . $row['id'] . "' class='btn btn-success'>Update</a> ";
                        echo "<a href='index.php?page=delete_blog&id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <a href="index.php?page=add-blog" class="btn btn-primary">New Blog</a>
        </div>
    </div>
</main>



