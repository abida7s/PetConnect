<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_email'])) {
    header("Location: ../login.html");
    exit();
}

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $userEmail = $_SESSION['user_email'];
    $userName  = $_SESSION['user_name'];

    $sql = "UPDATE pets
            SET
            status='Adopted',
            adopted_by='$userEmail',
            adopter_name='$userName'
            WHERE id=$id
            AND status='Available'";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
        alert('Pet adopted successfully!');
        window.location='../pets.php';
        </script>";

    } else {

        echo "Database Error: " . mysqli_error($conn);

    }

} else {

    header("Location: ../pets.php");
}
?>