<?php
require_once 'config/db_connection.php';
include './helper/helper.php';

include 'inc/header.php';

 $page = isset($_GET['page']) ? $_GET['page'] : 'home';
 
//var_dump($_SERVER['REQUEST_URI']);
$content = "";
switch ($page) {
    case 'home':
        $content = 'view/blogs/home.php';
        break;
    case 'register':
        $content = 'view/auth/register.php';
        break;
    case 'login':
        $content = 'view/auth/login.php';
        break;
    case 'logout':
        $content = 'view/auth/login.php';
        break;
    case 'blogs':
        $content = 'view/blogs/index.php';
        break;
    case 'contact':
        $content = 'view/blogs/contact.php';
        break;
    case 'about':
        $content = 'view/blogs/about.php';
            break;
    case 'post':
        $content = './post.php';
            break;
    case 'auth_register':
        $content = 'auth_register.php';
            break;
        
    default:
        $content = 'index.php';
        break;
}

if (file_exists($content)) {
    // var_dump($content);
    include $content;
    exit;
   
}
// } else {
//     include './view/errors/404.php';
//     exit;
// }

?>

<!-- Footer-->
<?php include './inc/footer.php'; ?>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="assets/js/scripts.js"></script>
</body>

</html>