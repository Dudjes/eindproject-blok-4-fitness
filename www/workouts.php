<?php
require "database.php";

$sql = "SELECT * FROM workout";
$result = mysqli_query($conn, $sql);
$workouts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET['tijd'])) {
    if ($_GET['tijd'] == 'asc') {
        $sql = "SELECT * FROM workout ORDER BY duur ASC";
    }
    if ($_GET['tijd'] == 'desc') {
        $sql = "SELECT * FROM workout ORDER BY duur DESC";
    }
    $result = mysqli_query($conn, $sql);
    $workouts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if (isset($_GET['diff'])) {
    $diff = $_GET['diff'];
    $allowed = ['beginner', 'gevorderd', 'expert'];
    if (in_array($diff, $allowed)) {
        $sql = "SELECT * FROM workout WHERE moeilijkheidsgraad = '$diff'";
        $result = mysqli_query($conn, $sql);
        $workouts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onze Workouts</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "header.php"; ?>
    <main>
        <div class="filters">
            <a href="?sort=">Normaal</a>
            <a href="?tijd=asc">kort > lang</a>
            <a href="?tijd=desc">lang > kort</a>
            <a href="?diff=beginner">beginner</a>
            <a href="?diff=gevorderd">gevorderd</a>
            <a href="?diff=expert">expert</a>
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
                    <a class="workout-detail-button" href="workout_detail.php?workout_id=<?php echo $workout['workout_id']; ?>">Meer info</a>
                </section>
            <?php } ?>
        </div>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>