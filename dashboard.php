<?php
session_start();

if(!isset($_SESSION['user_name'])){
    header("Location: login.html");
    exit();
}

include("php/db.php");

$email = $_SESSION['user_email'];

$check = mysqli_query($conn, "SELECT role FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($check);

$isAdmin = ($user['role'] == 'admin');

$totalPets = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM pets")
)['total'];

$adoptedPets = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM pets WHERE status='Adopted'")
)['total'];

$availablePets = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM pets WHERE status='Available'")
)['total'];

$totalUsers = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM users")
)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | PetConnect</title>

    <style>
        body{
            font-family:Poppins,sans-serif;
            background:#f5f7fb;
            margin:0;
            color:#333;
        }

        header{
            background:white;
            padding:18px 8%;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }

        .logo{
            font-size:28px;
            font-weight:700;
            color:#20b486;
        }

        nav a{
            margin-left:22px;
            text-decoration:none;
            color:#333;
            font-weight:600;
        }

        .hero{
            text-align:center;
            padding:50px 20px 30px;
        }

        .hero h1{
            font-size:42px;
            color:#173F5F;
            margin-bottom:10px;
        }

        .hero p{
            font-size:18px;
            color:#666;
        }

        .stats-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:25px;
            padding:0 8%;
            margin-top:20px;
        }

        .stat-card{
            background:white;
            border-radius:20px;
            padding:30px;
            text-align:center;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
        }

        .stat-card h2{
            font-size:44px;
            margin:0;
            color:#20b486;
        }

        .stat-card p{
            margin-top:12px;
            font-size:18px;
            font-weight:600;
            color:#555;
        }

        .adopted h2{ color:#ff6b6b; }
        .available h2{ color:#20b486; }
        .users h2{ color:#4e73df; }

        .actions{
            display:flex;
            justify-content:center;
            flex-wrap:wrap;
            gap:20px;
            margin:50px 20px;
        }

        .btn{
            padding:16px 28px;
            border-radius:14px;
            text-decoration:none;
            font-weight:700;
            color:white;
            transition:.3s;
            box-shadow:0 8px 18px rgba(0,0,0,.12);
        }

        .add{ background:#16a085; }
        .browse{ background:#20b486; }
        .requests{ background:#f39c12; }
        .adoptions{ background:#ff6b6b; }
        .profile{ background:#4e73df; }
        .admin{ background:#8e44ad; }

        .btn:hover{
            transform:translateY(-3px);
            opacity:.95;
        }

        .section{
            width:88%;
            margin:0 auto 50px;
            background:white;
            border-radius:22px;
            padding:30px;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
        }

        .section h2{
            color:#173F5F;
            margin-bottom:15px;
        }

        .quick-list{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:15px;
        }

        .quick-item{
            background:#f8fffd;
            border:1px solid #e8f5f0;
            border-radius:16px;
            padding:18px;
        }

        footer{
            text-align:center;
            padding:25px;
            color:#666;
        }
    </style>
</head>

<body>

<header>
    <div class="logo">🐾 PetConnect</div>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="pets.php">Browse Pets</a>
        <a href="requests.php">Requests</a>
        <a href="my_requests.php">My Requests</a>
        <a href="my_adoptions.php">My Adoptions</a>
        <a href="profile.php">My Profile</a>

        <?php if($isAdmin){ ?>
            <a href="admin.php">Admin Panel</a>
        <?php } ?>

        <a href="php/logout.php">Logout</a>
    </nav>
</header>

<section class="hero">

    <h1>Welcome, <?php echo $_SESSION['user_name']; ?> 👋</h1>

    <p>Manage your pets, requests, adoptions, and explore loving companions.</p>

</section>

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

<div class="actions">

    <a href="add_pet.php" class="btn add">➕ Add Pet</a>

    <a href="pets.php" class="btn browse">🐶 Browse Pets</a>

    <a href="requests.php" class="btn requests">📩 Requests</a>

    <a href="my_requests.php" class="btn requests">📨 My Requests</a>

    <a href="my_adoptions.php" class="btn adoptions">❤️ My Adoptions</a>

    <a href="profile.php" class="btn profile">👤 My Profile</a>

    <?php if($isAdmin){ ?>
        <a href="admin.php" class="btn admin">🛡️ Admin Panel</a>
    <?php } ?>

</div>

<div class="section">

    <h2>Quick Overview</h2>

    <div class="quick-list">

        <div class="quick-item">
            <b>Available Pets:</b><br>
            <?php echo $availablePets; ?> pets waiting for a home.
        </div>

        <div class="quick-item">
            <b>Adopted Pets:</b><br>
            <?php echo $adoptedPets; ?> pets found loving families.
        </div>

        <div class="quick-item">
            <b>Community:</b><br>
            <?php echo $totalUsers; ?> registered users.
        </div>

    </div>

</div>

<footer>

    © 2026 PetConnect | Dashboard

</footer>

</body>
</html>