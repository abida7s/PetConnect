<?php
session_start();
include('db.php');

if(!isset($_SESSION['user_email'])){
    header('Location: ../login.html');
    exit();
}

$email = $_SESSION['user_email'];

$check = mysqli_query($conn, "SELECT role FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($check);

if($user['role'] != 'admin'){
    die('Access Denied');
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM pets WHERE id='$id'");

header('Location: ../admin.php');
exit();
?>