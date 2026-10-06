<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        // If your passwords are stored as plain text
        if ($password == $user["password"]) {

            $_SESSION["user_name"] = $user["fullname"];
            $_SESSION["user_email"] = $user["email"];

            header("Location: ../index.php");
            exit();

        } else {

            echo "<script>
            alert('Incorrect password.');
            window.location='../login.html';
            </script>";

        }

    } else {

        echo "<script>
        alert('Email not found.');
        window.location='../login.html';
        </script>";

    }

}
?>