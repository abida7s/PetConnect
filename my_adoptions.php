<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit();
}

include("php/db.php");

$userEmail = $_SESSION['user_email'];

// Get only the pets adopted by the current user
$sql = "SELECT * FROM pets WHERE adopted_by='$userEmail'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Adoptions</title>

<link rel="stylesheet" href="css/pets.css">

</head>

<body>

<header>

<div class="logo">🐾 PetConnect</div>

<nav>

<a href="dashboard.php">Dashboard</a>

<a href="pets.php">Browse Pets</a>

<a href="profile.php">Profile</a>

<a href="php/logout.php">Logout</a>

</nav>

</header>

<h1 class="title">My Adopted Pets</h1>

<div class="container">

<?php

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

?>

<div class="card">

<img src="images/<?php echo $row['image']; ?>" alt="Pet">

<h2><?php echo $row['pet_name']; ?></h2>

<p><b>Breed:</b> <?php echo $row['breed']; ?></p>

<p><b>Age:</b> <?php echo $row['age']; ?></p>

<p><b>Gender:</b> <?php echo $row['gender']; ?></p>

<p><b>Vaccinated:</b> <?php echo $row['vaccinated']; ?></p>

<p style="color:#20b486;font-weight:600;">
❤️ Adopted by you
</p>

</div>

<?php

}

}else{

echo "<p style='text-align:center;width:100%;font-size:20px;color:#666;'>You haven't adopted any pets yet.</p>";

}

?>

</div>

</body>

</html>