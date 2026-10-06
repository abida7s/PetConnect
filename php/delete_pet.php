<?php
session_start();
include("db.php");

// User must be logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.html");
    exit();
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $userEmail = $_SESSION['user_email'];

    // Check if this pet belongs to the logged-in user
    $check = "SELECT * FROM pets
              WHERE id='$id'
              AND owner_email='$userEmail'";

    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) == 1) {

        // Delete the pet
        $sql = "DELETE FROM pets WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {

            echo "<script>
                    alert('Pet deleted successfully!');
                    window.location='../pets.php';
                  </script>";

        } else {

            echo "Database Error: " . mysqli_error($conn);

        }

    } else {

        echo "<script>
                alert('You are not allowed to delete this pet.');
                window.location='../pets.php';
              </script>";

    }
}
?>