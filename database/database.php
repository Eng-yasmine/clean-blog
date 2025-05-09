<?php
const SERVER_NAME = "localhost";
const USER_NAME = "root";
const PASSWORD = "";
const DATABASE_NAME = "blogs";


$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD);

if (!$conn) {
    die("connection failed : " . mysqli_connect_error());
}


if (!mysqli_select_db($conn, DATABASE_NAME)) {
    $sql = "CREATE DATABASE IF NOT EXISTS blogs";
    if (!mysqli_query($conn, $sql)) {
        $_SESSION['errors'] = "query not executed". mysqli_error($conn);
    }
    mysqli_select_db($conn, DATABASE_NAME);


$table_sql_user = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(25),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') NOT NULL DEFAULT 'user',
    visit_count INT DEFAULT 0 ,
    last_visit TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$query1 = mysqli_query($conn, $table_sql_user);
if (!$query1) {
    $_SESSION['errors'] = "query not excuted". mysqli_error($conn);
} else {
    $_ٍSESSION['success'] = "users table success created ";
}


$table_sql_post = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL ,
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255) DEFAULT NULL ,
    FOREIGN KEY (user_id) REFERENCES users(id)
    
)";
$query2 = mysqli_query($conn, $table_sql_post);
if (!$query2) {
    $_SESSION['errors'] = "query not excuted". mysqli_error($conn);
} else {
    $_ٍSESSION['success'] = "posts table success created ";
}


$table_sql_comment = "CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    post_id INT,
    user_id INT,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
$query3 = mysqli_query($conn, $table_sql_comment);
if (!$query3) {
    $_SESSION['errors'] = "query not excuted". mysqli_error($conn);
} else {

    $_ٍSESSION['success'] = "comment table success created ";
    var_dump($_ٍSESSION['success']);
}

$table_sql_contact = "CREATE TABLE IF NOT EXISTS contacts (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
email VARCHAR(50) NOT NULL,
phone VARCHAR(30) NOT NULL,
message TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP



)";

$query4 = mysqli_query($conn , $table_sql_contact);
if (!$query4) {
    $_SESSION['errors'] = "query not excuted". mysqli_error($conn);
} else {
   $_ٍSESSION['success'] = "contacts table success created ";
}

 mysqli_close($conn);


?>