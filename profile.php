<?php
session_start();

if(!isset($_SESSION['user_name'])){
    header("Location: login.html");
    exit();
}

include("php/db.php");

$userEmail = $_SESSION['user_email'];

$sql = "SELECT * FROM users WHERE email='$userEmail'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile</title>

<link rel="stylesheet" href="css/profile.css">

</head>

<body>

<header>

<div class="logo">🐾 PetConnect</div>

<nav>

<a href="dashboard.php">Dashboard</a>

<a href="pets.php">Browse Pets</a>

<a href="my_adoptions.php">My Adoptions</a>

<a href="php/logout.php">Logout</a>

</nav>

</header>

<div class="profile-card">

<h1>My Profile</h1>

<form action="php/update_profile.php" method="POST">

<label>Full Name</label>

<input
type="text"
name="fullname"
value="<?php echo $row['fullname']; ?>"
required>

<label>Email</label>

<label>Email</label>
<input type="email" value="<?php echo $row['email']; ?>" readonly>
<small style="color:#666;">Email cannot be changed</small>

<label>Phone</label>

<input
type="text"
name="phone"
value="<?php echo $row['phone']; ?>">

<label>Address</label>

<textarea
name="address"><?php echo $row['address']; ?></textarea>

<button type="submit">

Update Profile

</button>

</form>

</div>

</body>

</html>