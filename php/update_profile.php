<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.html");
    exit();
}

$currentEmail = $_SESSION['user_email'];

$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "UPDATE users
        SET
        fullname='$fullname',
        phone='$phone',
        address='$address'
        WHERE email='$currentEmail'";

if (mysqli_query($conn, $sql)) {

    $_SESSION['user_name'] = $fullname;

    echo "<script>
    alert('Profile Updated Successfully!');
    window.location='../profile.php';
    </script>";

} else {

    echo "Database Error: " . mysqli_error($conn);

}
?>