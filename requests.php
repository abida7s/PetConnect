<?php
session_start();
include("php/db.php");

if(!isset($_SESSION['user_email'])){
    header("Location: login.html");
    exit();
}

$ownerEmail = $_SESSION['user_email'];

$sql = "SELECT r.*, p.pet_name, p.image
        FROM adoption_requests r
        JOIN pets p ON r.pet_id = p.id
        WHERE r.owner_email='$ownerEmail'
        ORDER BY r.requested_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Adoption Requests</title>
<style>
body{
    font-family:Poppins,sans-serif;
    background:#f5f7fb;
    padding:30px;
}
.card{
    background:white;
    border-radius:18px;
    padding:20px;
    margin-bottom:20px;
    display:flex;
    align-items:center;
    gap:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}
.card img{
    width:110px;
    height:110px;
    object-fit:cover;
    border-radius:14px;
}
.info{ flex:1; }
.approve,.reject{
    padding:10px 16px;
    border-radius:10px;
    text-decoration:none;
    color:white;
    font-weight:600;
}
.approve{ background:#20b486; }
.reject{ background:#e74c3c; }
.pending{ color:#f39c12; font-weight:700; }
.approved{ color:#20b486; font-weight:700; }
.rejected{ color:#e74c3c; font-weight:700; }
</style>
</head>
<body>

<h1>📩 Adoption Requests</h1>

<?php if(mysqli_num_rows($result) > 0){ ?>

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

    <div class="card">

        <img src="images/<?php echo $row['image']; ?>">

        <div class="info">

            <h2><?php echo $row['pet_name']; ?></h2>

            <p><b>Requester:</b> <?php echo $row['requester_name']; ?></p>

            <p><b>Email:</b> <?php echo $row['requester_email']; ?></p>

            <p class="<?php echo strtolower($row['status']); ?>">
                Status: <?php echo $row['status']; ?>
            </p>

        </div>

        <?php if($row['status'] == 'Pending'){ ?>

            <a class="approve"
               href="php/approve_request.php?id=<?php echo $row['id']; ?>">
               Approve
            </a>

            <a class="reject"
               href="php/reject_request.php?id=<?php echo $row['id']; ?>">
               Reject
            </a>

        <?php } ?>

    </div>

    <?php } ?>

<?php } else { ?>

    <p>No requests for your pets yet.</p>

<?php } ?>

</body>
</html>