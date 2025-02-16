<?php
require_once 'config/db_connection.php';
include './helper/helper.php';

include 'inc/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

//var_dump($_SERVER['REQUEST_URI']);
//$content = "";
switch ($page) {
    case 'home':
        include 'view/home.php';
        break;
    case 'register':
        include 'view/auth/register.php';
        break;
    case 'login':
        include 'view/auth/login.php';
        break;
    case 'logout':
        include 'view/auth/login.php';
        break;
    case 'blogs':
        include 'view/blogs/index.php';
        break;
    case 'contact':
        include 'view/contact.php';
        break;
    case 'about':
        include 'view/about.php';
        break;
    case 'post':
        include 'view/post.php';
        break;
    case 'auth_register':
        include 'controllers/auth/auth_register.php';
        break;
    case 'auth-login':
        include 'controllers/auth/auth-login.php';
        break;
    case 'profil':
        include 'view/profil.php';
        break;
        case 'add_blog':
        include 'view/blogs/add_blog.php';
        break;

    default:
        include 'index.php';
        break;

}



?>

<!-- Footer-->
<?php include './inc/footer.php'; ?>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="assets/js/scripts.js"></script>
</body>

</html>