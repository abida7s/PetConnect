<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: login.html");
    exit();
}

include("php/db.php");

$sql = "SELECT * FROM pets ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$myEmail = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Pets | PetConnect</title>

    <link rel="stylesheet" href="css/pets.css">
</head>

<body>

<header>

    <div class="logo">🐾 PetConnect</div>

    <nav>

        <a href="dashboard.php">Dashboard</a>

        <a href="requests.php">Requests</a>

        <a href="my_requests.php">My Requests</a>

        <a href="php/logout.php">Logout</a>

    </nav>

</header>

<h1 class="title">Browse Pets</h1>

<div class="container">

<?php if(mysqli_num_rows($result) > 0){ ?>

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

    <div class="card">

        <a href="pet_details.php?id=<?php echo $row['id']; ?>">

            <img src="images/<?php echo $row['image']; ?>" alt="Pet">

        </a>

        <h2>

            <a href="pet_details.php?id=<?php echo $row['id']; ?>" class="pet-link">

                <?php echo $row['pet_name']; ?>

            </a>

        </h2>

        <p><b>Breed:</b> <?php echo $row['breed']; ?></p>

        <p><b>Age:</b> <?php echo $row['age']; ?></p>

        <p><b>Gender:</b> <?php echo $row['gender']; ?></p>

        <p><b>Vaccinated:</b> <?php echo $row['vaccinated']; ?></p>

        <p><b>Status:</b> <?php echo $row['status']; ?></p>

        <?php if($row['status'] == 'Adopted'){ ?>

            <p style="color:#20b486;font-weight:600;">

                ❤️ Adopted by: <b><?php echo $row['adopter_name']; ?></b>

            </p>

        <?php } ?>

        <div class="buttons">

            <?php
            if($row['status'] == 'Available' && $row['owner_email'] != $myEmail){
            ?>

                <a href="php/request_adoption.php?id=<?php echo $row['id']; ?>"
                   class="adopt-btn"
                   onclick="return confirm('Send adoption request for this pet?');">

                   Request Adoption

                </a>

            <?php } elseif($row['owner_email'] == $myEmail){ ?>

                <button disabled>Your Pet</button>

            <?php } else { ?>

                <button disabled>Already Adopted</button>

            <?php } ?>

            <?php if($row['owner_email'] == $myEmail){ ?>

                <a href="php/delete_pet.php?id=<?php echo $row['id']; ?>"
                   class="delete-btn"
                   onclick="return confirm('Delete this pet permanently?');">

                   Delete

                </a>

            <?php } ?>

        </div>

    </div>

    <?php } ?>

<?php } else { ?>

    <p style="text-align:center;width:100%;font-size:20px;color:#666;">

        No pets available right now.

    </p>

<?php } ?>

</div>

</body>
</html>