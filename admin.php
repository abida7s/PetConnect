<?php
session_start();
include('php/db.php');

if(!isset($_SESSION['user_email'])){
    header('Location: login.html');
    exit();
}

$email = $_SESSION['user_email'];

$check = mysqli_query($conn, "SELECT role FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($check);

if($user['role'] != 'admin'){
    die('Access Denied');
}

$totalPets = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pets"))['total'];

$adoptedPets = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pets WHERE status='Adopted'"))['total'];

$availablePets = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pets WHERE status='Available'"))['total'];

$totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];

$pets = mysqli_query($conn, "SELECT * FROM pets ORDER BY id DESC");
$users = mysqli_query($conn, "SELECT * FROM users ORDER BY fullname ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel | PetConnect</title>
<link rel="stylesheet" href="css/admin.css">
</head>

<body>

<header>
    <div class="logo">🐾 PetConnect Admin</div>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="php/logout.php">Logout</a>
    </nav>
</header>

<h1 class="page-title">📊 Statistics Dashboard</h1>

<div class="stats-grid">

    <div class="stat-card">
        <h2><?php echo $totalPets; ?></h2>
        <p>Total Pets</p>
    </div>

    <div class="stat-card adopted">
        <h2><?php echo $adoptedPets; ?></h2>
        <p>Adopted Pets</p>
    </div>

    <div class="stat-card available">
        <h2><?php echo $availablePets; ?></h2>
        <p>Available Pets</p>
    </div>

    <div class="stat-card users">
        <h2><?php echo $totalUsers; ?></h2>
        <p>Total Users</p>
    </div>

</div>

<h1 class="section-title">🐶 Manage Pets</h1>

<div class="table-container">
<table>

<tr>
    <th>ID</th>
    <th>Pet</th>
    <th>Status</th>
    <th>Owner</th>
    <th>Adopted By</th>
    <th>Action</th>
</tr>

<?php while($pet = mysqli_fetch_assoc($pets)){ ?>

<tr>

    <td><?php echo $pet['id']; ?></td>

    <td><?php echo $pet['pet_name']; ?></td>

    <td><?php echo $pet['status']; ?></td>

    <td><?php echo $pet['owner_email']; ?></td>

    <td><?php echo $pet['adopter_name']; ?></td>

    <td>
        <a class="delete-btn"
           href="php/admin_delete_pet.php?id=<?php echo $pet['id']; ?>"
           onclick="return confirm('Delete this pet?')">
           Delete
        </a>
    </td>

</tr>

<?php } ?>

</table>
</div>

<h1 class="section-title">👥 Manage Users</h1>

<div class="table-container">
<table>

<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
</tr>

<?php while($u = mysqli_fetch_assoc($users)){ ?>

<tr>

    <td><?php echo $u['fullname']; ?></td>

    <td><?php echo $u['email']; ?></td>

    <td><?php echo $u['role']; ?></td>

</tr>

<?php } ?>

</table>
</div>

</body>
</html>