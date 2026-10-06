<?php
session_start();

if(!isset($_SESSION['user_name'])){
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pet | PetConnect</title>

    <link rel="stylesheet" href="css/add_pet.css">
</head>

<body>

<header class="navbar">

    <div class="logo">
        🐾 PetConnect
    </div>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="pets.php">Browse Pets</a>
        <a href="php/logout.php">Logout</a>
    </nav>

</header>

<div class="container">

<h1>Add a Pet for Adoption</h1>

<form action="php/add_pet.php" method="POST" enctype="multipart/form-data">

    <label>Pet Name</label>
    <input type="text" name="pet_name" required>

    <label>Breed</label>
    <input type="text" name="breed" required>

    <label>Age</label>
    <input type="text" name="age" required>

    <label>Gender</label>

    <select name="gender" required>
        <option value="">Select Gender</option>
        <option>Male</option>
        <option>Female</option>
    </select>

    <label>Vaccinated</label>

    <select name="vaccinated" required>
        <option value="">Select</option>
        <option>Yes</option>
        <option>No</option>
    </select>

    <label>Description</label>

    <textarea name="description" rows="5"></textarea>

    <label>Pet Image</label>

    <input type="file" name="image" accept="image/*" required>

    <button type="submit">
        Add Pet
    </button>

</form>

</div>

</body>
</html>