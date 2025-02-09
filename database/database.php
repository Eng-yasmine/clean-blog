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
    $sql = "CREATE DATABASE blogs";
    if (!mysqli_query($conn, $sql)) {
        die("فشل إنشاء قاعدة البيانات: " . mysqli_error($conn));
    }
    mysqli_select_db($conn, DATABASE_NAME);
}

// إنشاء جدول users
$table_sql_user = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255)
)";
$query1 = mysqli_query($conn, $table_sql_user);
if (!$query1) {
    die("فشل تنفيذ الاستعلام 1: " . mysqli_error($conn));
}

// إنشاء جدول posts
$table_sql_post = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT
)";
$query2 = mysqli_query($conn, $table_sql_post);
if (!$query2) {
    die("فشل تنفيذ الاستعلام 2: " . mysqli_error($conn));
}

// CREATE TABLE OF comment
$table_sql_comment = "CREATE TABLE IF NOT EXISTS comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    post_id INT,
    user_id INT
)";
$query3 = mysqli_query($conn, $table_sql_comment);
if (!$query3) {
    die("فشل تنفيذ الاستعلام 3: " . mysqli_error($conn));
}

// إغلاق الاتصال


//echo "تم إنشاء الجداول بنجاح!";
?>












