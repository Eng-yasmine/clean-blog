<?php 
require_once 'config/db_connection.php'; 
include './helper/helper.php';



 include 'inc/header.php'; 


 $page = isset($_GET['page']) ? $_GET['page'] : 'home';
 $content = '';
 
 switch ($page) {
     case 'home':
         $content = './view/blogs/home.php';
         break;
     case 'register':
         $content = './view/auth/register.php';
         break;
     case 'sign-up':
         $content = './controllers/auth/sign-up.php';
         break;
         case 'login':
         $content = './view/auth/login.php';
         break;
         case 'logout':
         $content = './controllers/auth/logout.php';
         break;
         case 'auth-login':
         $content = './controllers/auth/auth-login.php';
         break;
         case 'add_blog':
         $content = './controllers/blogs/add_blogs.php';
         break;
     default:
         $content = './view/errors/404.php'; 
         break;
 }
 
 if (file_exists($content)) {
     include $content;
 } else {
     include './view/errors/404.php'; 
     exit ;
 }





?>


<?php 
include $content;

?>

<!-- Footer-->
<?php include './inc/footer.php'; ?>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="assets/js/scripts.js"></script>
</body>

</html>