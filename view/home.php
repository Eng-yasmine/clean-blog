<?php
require_once 'config/db_connection.php';

if(!isset($_SESSION['username'])){
    header("location:index.php?page=login");
    exit;
}
$sql = "SELECT posts.* , users.name FROM posts JOIN users ON posts.user_id=users.id ORDER BY posts.created_at DESC";
try{
$query = mysqli_query($conn , $sql);
if(!$query){
    $_SESSION['errors'] = "connection failed" . mysqli_connect_error($conn);
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit;
}
}catch(Exception $ex){
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
      <!DOCTYPE html>
      <html lang="en">
      <!-- Main Content-->
      <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                     <?php 
                     while($row = mysqli_fetch_assoc($query)):
                
                      var_dump($row);
                    
                      ?>
                    <div class="post-preview">
                        <a href="index.php?page=post&id=<?= $row['id']  ?>">
                            <h2 class="post-title"><?= $row['title']  ?></h2>
                            <h3 class="post-subtitle"><?= $row['content']  ?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="index.php?page=profile&user="><?= $row['name']  ?> </a>
                            on  <?= $row['created_at']  ?>  </p>  
                    </div>
                  
                    <!-- Divider-->
                    <hr class="my-4" />
                  <?php endwhile; ?>
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
                </div>
            </div>
        </div>
