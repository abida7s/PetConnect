<?php
session_start();
include("db.php");

// User must be logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pet_name = $_POST['pet_name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $vaccinated = $_POST['vaccinated'];
    $description = $_POST['description'];

    // Store owner email
    $owner_email = $_SESSION['user_email'];

    // Upload image
    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp, "../images/" . $image);

    // Insert into database
    $sql = "INSERT INTO pets
    (pet_name, breed, age, gender, vaccinated, description, image, status, owner_email)
    VALUES
    ('$pet_name','$breed','$age','$gender','$vaccinated','$description','$image','Available','$owner_email')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Pet added successfully!');
                window.location='../pets.php';
              </script>";

    } else {

        echo "Database Error: " . mysqli_error($conn);

    }
}
?>