<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_email'])){
    header("Location: ../login.html");
    exit();
}

$petId = $_GET['id'];

$requesterEmail = $_SESSION['user_email'];
$requesterName  = $_SESSION['user_name'];

$pet = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM pets WHERE id='$petId'")
);

if(!$pet){
    die("Pet not found");
}

if($pet['owner_email'] == $requesterEmail){
    echo "<script>
    alert('You cannot request your own pet.');
    window.location='../pets.php';
    </script>";
    exit();
}

$check = mysqli_query($conn,
    "SELECT * FROM adoption_requests
     WHERE pet_id='$petId'
     AND requester_email='$requesterEmail'
     AND status='Pending'"
);

if(mysqli_num_rows($check) > 0){
    echo "<script>
    alert('You already sent a request.');
    window.location='../pets.php';
    </script>";
    exit();
}

$ownerEmail = $pet['owner_email'];

$sql = "INSERT INTO adoption_requests
        (pet_id, requester_email, requester_name, owner_email, status)
        VALUES
        ('$petId', '$requesterEmail', '$requesterName', '$ownerEmail', 'Pending')";

if(mysqli_query($conn, $sql)){

    echo "<script>
    alert('Request sent successfully!');
    window.location='../my_requests.php';
    </script>";

}else{

    echo mysqli_error($conn);

}
?>