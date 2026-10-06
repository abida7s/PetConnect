<?php
session_start();
include("php/db.php");

$email = $_SESSION['user_email'];

$sql = "SELECT r.*, p.pet_name
        FROM adoption_requests r
        JOIN pets p ON r.pet_id = p.id
        WHERE r.requester_email='$email'
        ORDER BY r.requested_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Requests</title>
<style>
body{
    font-family:Poppins,sans-serif;
    background:#f5f7fb;
    padding:30px;
}
.card{
    background:white;
    padding:20px;
    border-radius:16px;
    margin-bottom:15px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}
.pending{ color:#f39c12; font-weight:700; }
.approved{ color:#20b486; font-weight:700; }
.rejected{ color:#e74c3c; font-weight:700; }
</style>
</head>
<body>

<h1>📨 My Adoption Requests</h1>

<?php if(mysqli_num_rows($result) > 0){ ?>

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

    <div class="card">

        <h2><?php echo $row['pet_name']; ?></h2>

        <p>Status:
            <span class="<?php echo strtolower($row['status']); ?>">
                <?php echo $row['status']; ?>
            </span>
        </p>

    </div>

    <?php } ?>

<?php } else { ?>

    <p>You have not sent any adoption requests yet.</p>

<?php } ?>

</body>
</html>