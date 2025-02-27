<?php
require_once 'config/db_connection.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("location:index.php?page=login");
    exit;
}


$sql_users = "SELECT id, name, email, visit_count, last_visit FROM users ORDER BY visit_count DESC";
$query_users = mysqli_query($conn, $sql_users);

$sql_contacts = "SELECT name, email, phone, message, created_at FROM contacts ORDER BY created_at DESC";
$query_contacts = mysqli_query($conn, $sql_contacts);


include 'views/auth/admin_dashboard.php';