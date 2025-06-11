<?php  
require "database.php";


$id = $_GET['workout_id'];

$sql = "SELECT * FROM workout WHERE workout_id = $id";
$result = mysqli_query($conn, $sql);
$workout_info = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $workouts_info['titel'];?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php";?>
    <h1><?php echo $workout_info['titel'];?></h1>
    <?php include "footer.php";?>
</body>
</html>