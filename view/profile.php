<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once 'config/db_connection.php';
echo "welcome in your profile" ;
?>

<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="index.php?page=add-blog" method="POST" enctype="multipart/form-data">
                <h2 class="form-title"><?php echo $_SESSION['username'] ;   ?></h2>
                <div class="form-group mb-3">
                    <label class="form-label"></label>
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
                        echo "<a href='?id=" .  $row['id']  . "' class='btn btn-success'>UPDATE</a>";
                        echo "<a href='delete_blog.php?id=" . $row['id'] . "' class='btn btn-danger'>DELETE</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
             
                    <button type="submit" class="btn btn-primary"> new Blog</button>
           
            </form>
            </div>
</main>
</body>





