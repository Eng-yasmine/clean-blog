<?php
require_once 'helper/session.php' ;
require_once 'inc/nav.php';
require_once 'config/db_connection.php';
include './helper/helper.php';

include 'inc/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

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
        include 'controllers/auth/auth_logout.php';
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
    case 'auth_login':
        include 'controllers/auth/auth_login.php';
        break;
    case 'profile':
        include 'view/profile.php';
        break;
    case 'add-blog':
        include 'view/blogs/add-blog.php';
        break;
    case 'add_blog':
        include 'controllers/blogs/add_blog.php';
        break;
    case 'add_comment':
        include 'controllers/blogs/add_comment.php';
        break;

    case 'contact-controller':
        include 'controllers/contact-controller.php';
        break;
        case 'update_blog':
        include 'controllers/blogs/update_blog.php';
        break;
        case 'delete_blog':
        include 'controllers/blogs/delete_blog.php';
        break;

    default:
        include 'view/maintainence.php';
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