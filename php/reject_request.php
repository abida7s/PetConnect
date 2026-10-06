<?php
session_start();
include("db.php");

$id = $_GET['id'];

mysqli_query($conn,
    "UPDATE adoption_requests
     SET status='Rejected'
     WHERE id='$id'"
);

header("Location: ../requests.php");
exit();
?>