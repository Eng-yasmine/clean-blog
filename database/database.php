<?php
const SERVER_NAME = "localhost";
const USER_NAME = "root";
const PASSWORD = "";
const DATABASE_NAME = "blogs";

// الاتصال بقاعدة البيانات
$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD);

if (!$conn) {
    die("فشل الاتصال: " . mysqli_connect_error());
}

// إنشاء قاعدة البيانات إذا لم تكن موجودة
if (!mysqli_select_db($conn, DATABASE_NAME)) {
    $sql = "CREATE DATABASE IF NOT EXISTS blogs";
    if (!mysqli_query($conn, $sql)) {
        die("فشل إنشاء قاعدة البيانات: " . mysqli_error($conn));
    }
    mysqli_select_db($conn, DATABASE_NAME);
}

// إنشاء جدول users
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
    die("فشل تنفيذ الاستعلام 1: " . mysqli_error($conn));
} else {
    echo "تم إنشاء جدول users بنجاح!<br>";
}

// إنشاء جدول posts
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
    die("فشل تنفيذ الاستعلام 2: " . mysqli_error($conn));
} else {
    echo "تم إنشاء جدول posts بنجاح!<br>";
}

// إنشاء جدول comment
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
    die("فشل تنفيذ الاستعلام 3: " . mysqli_error($conn));
} else {
    echo "تم إنشاء جدول comment بنجاح!<br>";
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
    die("فشل تنفيذ الاستعلام 3: " . mysqli_error($conn));
} else {
    echo "تم إنشاء جدول contacts بنجاح!<br>";
}

// إغلاق الاتصال
 mysqli_close($conn);

echo "تم تنفيذ جميع العمليات بنجاح!";
?>