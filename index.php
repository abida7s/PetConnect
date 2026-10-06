<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTFa-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetConnect</title>

    <link rel="stylesheet" href="css/landing.css">
</head>

<body>

<!-- Navigation -->

<nav class="navbar">

    <div class="logo">
        <span>🐾</span> PetConnect
    </div>

    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#contact">Contact</a></li>

        <?php if(isset($_SESSION['user_name'])) { ?>
           <li><a href="php/logout.php" onclick="return confirm('Are you sure you want to log out?');">Logout</a></li>
        <?php } else { ?>
            <li><a href="login.html">Login</a></li>
        <?php } ?>

    </ul>

</nav>

<!-- Hero Section -->

<section class="hero">

    <div class="hero-text">

        <?php if(isset($_SESSION['user_name'])) { ?>

        <div class="welcome-banner">

            <h2>🐾 Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>

            <p>✅ You are successfully logged in.</p>

            <p>Find your perfect furry companion today.</p>

        </div>

        <?php } ?>

        <h1>
            Adopt a Friend,<br>
            Change a Life ❤️
        </h1>

        <p>
            Welcome to PetConnect, a trusted pet adoption platform where
            loving families meet adorable pets looking for their forever homes.
            Safe, simple, and full of love.
        </p>

        <div class="buttons">

            <?php if(!isset($_SESSION['user_name'])) { ?>

                <a href="register.html" class="btn primary">
                    Get Started
                </a>

                <a href="login.html" class="btn secondary">
                    Login
                </a>

            <?php } else { ?>

                <a href="dashboard.php" class="btn primary">
                    Explore Pets
                </a>

            <?php } ?>

        </div>

    </div>

    <div class="hero-image">
        <img src="images/pet.png" alt="Pet">
    </div>

</section>

<!-- About -->

<section id="about" class="about">

    <h2>About PetConnect</h2>

    <p>
        PetConnect is a web-based pet adoption platform that connects
        adopters with pet owners and shelters. Our goal is to make
        pet adoption easy, safe, and reliable.
    </p>

</section>

<!-- Features -->

<section id="features">

    <h2 class="section-title">Why Choose PetConnect?</h2>

    <div class="features">

        <div class="card">
            <h2>🐶 Safe Adoption</h2>

            <p>
                Verified users ensure a secure and trustworthy adoption experience.
            </p>

        </div>

        <div class="card">

            <h2>🐱 Verified Pets</h2>

            <p>
                Every pet profile is reviewed before being published.
            </p>

        </div>

        <div class="card">

            <h2>❤️ Easy Registration</h2>

            <p>
                Register in minutes and start your adoption journey today.
            </p>

        </div>

    </div>

</section>

<!-- Contact -->

<section id="contact" class="about">

    <h2>Contact Us</h2>

    <p>Email : petconnect@gmail.com</p>

    <p>Phone : +880 123456789</p>

</section>

<!-- Footer -->

<footer>

    <p>
        © 2026 PetConnect | Web Programming Project
    </p>

</footer>

</body>
</html>