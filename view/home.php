<?php
require_once 'config/db_connection.php';

if (!isset($_SESSION['username'])) {
    header("location:index.php?page=login");
    exit;
}


$sql = "SELECT posts.*, users.name FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC";

try {
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        $_SESSION['errors'] = "Connection failed: " . mysqli_error($conn);
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }
} catch (Exception $ex) {
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit;
}
?>

<!-- Main Content -->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">

            <!-- Loop through posts -->
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <div class="post-preview">
                    <a href="index.php?page=post&id=<?= $row['id'] ?>">
                        <h2 class="post-title"><?= htmlspecialchars($row['title']) ?></h2>
                        <h3 class="post-subtitle"><?= htmlspecialchars($row['content']) ?></h3>
                    </a>
                    <p class="post-meta">
                        Posted by <a href="index.php?page=profile"><?= htmlspecialchars($row['name']) ?></a>
                        on <?= $row['created_at'] ?>
                    </p>
                </div>

                <?php
                $post_id = $row['id'];
                $sql_comments = "SELECT comments.*, users.name FROM comments 
                                 JOIN users ON comments.user_id = users.id 
                                 WHERE comments.post_id = $post_id 
                                 ORDER BY comments.created_at ASC";

                $query_comments = mysqli_query($conn, $sql_comments);
                ?>

                <div class="comments-section">
                    <h4>Comments</h4>
                    <?php if (mysqli_num_rows($query_comments) > 0): ?>
                        <?php while ($comment = mysqli_fetch_assoc($query_comments)): ?>
                            <div class="comment">
                                <p><strong><?= htmlspecialchars($comment['name']) ?>:</strong> <?= htmlspecialchars($comment['comment']) ?></p>
                                <small><?= $comment['created_at'] ?></small>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No comments yet.</p>
                    <?php endif; ?>
                </div>

             
                <form action="index.php?page=add_comment" method="POST">
                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                    <div class="form-floating">
                        <input class="form-control" name="comment" type="text" placeholder="Enter your comment..." required />
                        <label for="comment">Write a comment</label>
                    </div>
                    <br />
                    <button class="btn btn-primary text-uppercase" type="submit">Send Comment</button>
                </form>

                <!-- Divider -->
                <hr class="my-4" />

            <?php endwhile; ?>

            <!-- Pager -->
            <div class="d-flex justify-content-end mb-4">
                <a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a>
            </div>

        </div>
    </div>
</div>