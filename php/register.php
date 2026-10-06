<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $sql = "INSERT INTO users (fullname, email, password, role)
            VALUES ('$fullname', '$email', '$password', '$role')";

    if ($conn->query($sql)) {
        echo "<h2>Registration Successful!</h2>";
        echo "<a href='../login.html'>Go to Login</a>";
    } else {
        die("SQL Error: " . $conn->error);
    }

} else {
    die("This page must be accessed through the registration form.");
}
?>