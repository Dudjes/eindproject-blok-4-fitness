<?php
require "database.php";

$sql = "SELECT * FROM workout WHERE workout_id < 5";
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
    <main>
        <div class="welkom">
            <h1>Welcome to our fitness website</h1>
            <p>Here are some of our most populair workouts:</p>
        </div>
        <div class="workout-section">
            <?php foreach ($workouts_info as $workout) { ?>
                <section class="workout">
                    <img class="image-workout" src="afbeeldingen/<?php echo $workout["afbeelding"]; ?>" alt="<?php echo $workout["afbeelding"]; ?>">
                    <div class="workout-text">
                        <h1> <?php echo $workout["titel"]; ?></h1>
                        <h2>Duur: <?php echo substr($workout["duur"], 0, 5); ?></h2>
                        <p>📝 <?php echo $workout["beschrijving"]; ?></p>
                        <p>📌 Notitie: <?php echo $workout["notitie"]; ?></p>
                    </div>
                </section>
            <?php } ?>
        </div>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>