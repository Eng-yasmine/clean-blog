<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim(htmlspecialchars(htmlentities($_POST['name'])));
    $email = trim(htmlspecialchars(htmlentities($_POST['email'])));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $phone = trim(htmlspecialchars(htmlentities($_POST['phone'])));
    $phone = intval($phone);
    $password = trim(htmlspecialchars(htmlentities($_POST['password'])));



    if (
        empty($name) || empty($email) || empty($password) || empty($phone)
    ) {
        $_SESSION['errors'] = "this feild is required";
        header("location" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if ($name < 6 || $name > 15) {
        $_SESSION['errors'] = "sorry ! name must be between 6 and 15 charcter";
        header("location" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (!$email) {

        $_SESSION['errors'] = "please type valid email";
        header("location" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (!$phone) {
        $_SESSION['errors'] = "please type valid phone number";
        header("location" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if ($password > 15 || $password < 8) {
        $_SESSION['errors'] = "sorry ! password must be between 8 and 15 ";
        header("location" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO  `users` (`name`,`email`,`phone`,`password`)
    VALUE($name,$email,$phone,$password_hash)";
    try {
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $_SESSION['username'] = $name;
            header("location:./index.php");
            exit;
        } else {
            $_SESSION['errors'] = "failed to register";
            header("location" . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } catch (Exception $ex) {
        $_SESSION['errors'] = "failed to register";
        header("location" . $_SERVER['HTTP_REFERER']);
        exit;
    }
} else {
    $_SESSION['errors'] = "this invalid request";
    header("location" . $_SERVER['HTTP_REFERER']);
    exit;
}
