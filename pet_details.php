<?php
session_start();

if(!isset($_SESSION['user_name'])){
    header("Location: login.html");
    exit();
}

include("php/db.php");

if(!isset($_GET['id'])){
    header("Location: pets.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM pets WHERE id='$id'";
$result = mysqli_query($conn,$sql);

$pet = mysqli_fetch_assoc($result);

if(!$pet){
    die("Pet not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $pet['pet_name']; ?></title>

<link rel="stylesheet" href="css/pet_details.css">

</head>

<body>

<header>

<div class="logo">
🐾 PetConnect
</div>

<nav>

<a href="dashboard.php">Dashboard</a>

<a href="pets.php">Browse Pets</a>

<a href="my_adoptions.php">My Adoptions</a>

<a href="php/logout.php">Logout</a>

</nav>

</header>

<div class="container">

<div class="image">

<img src="images/<?php echo $pet['image']; ?>">

</div>

<div class="details">

<h1><?php echo $pet['pet_name']; ?></h1>

<p><b>Breed:</b> <?php echo $pet['breed']; ?></p>

<p><b>Age:</b> <?php echo $pet['age']; ?></p>

<p><b>Gender:</b> <?php echo $pet['gender']; ?></p>

<p><b>Vaccinated:</b> <?php echo $pet['vaccinated']; ?></p>

<p><b>Status:</b> <?php echo $pet['status']; ?></p>

<h3>Description</h3>

<p><?php echo $pet['description']; ?></p>

<?php

if($pet['status']=="Available"){

?>

<a class="adopt"
href="php/adopt_pet.php?id=<?php echo $pet['id']; ?>">
Adopt This Pet
</a>

<?php

}else{

?>

<button disabled>
Already Adopted
</button>

<?php

}

?>

<br><br>

<a class="back" href="pets.php">
← Back to Browse Pets
</a>

</div>

</div>

</body>

</html>