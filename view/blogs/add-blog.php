<?php
 require_once 'config/db_connection.php'; 
 require_once 'helper/session.php'; 
 ?>


<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="<?= isset($_GET['id']) ? 'index.php?page=update_blog&id=' .$_GET['id'] : 'index.php?page=add_blog' ?>" method="POST" enctype="multipart/form-data">
               <h2 class="form-title">Add New Blog Post</h2>
                <?= successmessage(); ?>
                <?= errormessage(); ?>
               <div class="form-group mb-3">
                    <label class="form-label">Blog Title</label>
                    <input type="text" name="title" value="<?= isset($update_blog['title']) ? $update_blog['title'] : ""; ?>" class="form-control" placeholder="Enter the post title" >
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Content</label>
                    <input type="text" name="content" value="<?= isset($update_blog['content']) ? $update_blog['content'] : ""; ?>" class="form-control" placeholder="Enter a short description of the post" >
                </div>
                <div class="form-group mb-3">
                    <label class="form-label"></label>
                    <input type="file" name="image[]" value="<?= isset($update_blog['image']) ? $update_blog['image'] : ""; ?>" class="form-control" placeholder="Enter a short description of the post" multiple>
                </div>
                
                <?php if (isset($_GET['id'])) : ?>
                <button type="submit" class="btn btn-primary">Update Blog</button>

                <?php else : ?>
                    <button type="submit" class="btn btn-primary">Add Blog</button>
                <?php endif ;?>
            </form>

            <h2 class="text-center">Blog Posts</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>images</th>
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
                        echo "<td><img src=' " . $row['image'] . " 'width='100'></td>";
                        echo "<td>";
                        if(isset($_SESSION['username'])){
                        echo "<a href='index.php?page=add_blog&id=". $row['id'] . "' class='btn btn-success'>UPDATE</a>";
                        echo "<a href='delete_blog.php?id=" . $row['id'] . "' class='btn btn-danger'>DELETE</a>";
                        }
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