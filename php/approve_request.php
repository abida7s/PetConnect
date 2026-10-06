<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_email'])){
    exit();
}

$id = $_GET['id'];

$request = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM adoption_requests WHERE id='$id'")
);

if(!$request){
    die("Request not found");
}

mysqli_query($conn,
    "UPDATE adoption_requests
     SET status='Approved'
     WHERE id='$id'"
);

mysqli_query($conn,
    "UPDATE pets
     SET status='Adopted',
         adopted_by='{$request['requester_email']}',
         adopter_name='{$request['requester_name']}'
     WHERE id='{$request['pet_id']}'"
);

mysqli_query($conn,
    "UPDATE adoption_requests
     SET status='Rejected'
     WHERE pet_id='{$request['pet_id']}'
     AND id!='$id'"
);

header("Location: ../requests.php");
exit();
?>