<?php
require "database.php";

$sql = "SELECT * FROM workout WHERE workout_id < 4";
$result = mysqli_query($conn, $sql);
$workouts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "header.php"; ?>
    <div class="welkom">
        <h1>Welcome to our fitness website</h1>
        <p>Here are some of our most populair workouts:</p>
    </div>
    <?php foreach ($workouts_info as $workout) {
    } ?>
    <?php include "footer.php"; ?>
</body>

</html>