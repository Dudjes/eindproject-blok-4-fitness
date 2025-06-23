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
    <main>
        <div class="workout-detail">
            <div class="workout-img">
                <img src="<?php echo $workout_info['afbeelding'];?>" alt="afbeelding workout">
            </div>
            <div class="workout-detail-text">
                <div class="workout-detail-text-titel">
                    <h1><?php echo $workout_info['titel'];?>  voor: <?php echo $workout_info['moeilijkheidsgraad'];?></h1>
                </div>
                <div>
                    <p><?php echo substr($workout_info["duur"], 0, 5);?></p>
                    <?php echo $workout_info['notitie'];?>
                    <?php echo $workout_info['beschrijving'];?>
                </div>
            </div>
        </div>
    </main>
    <?php include "footer.php";?>
</body>
</html>