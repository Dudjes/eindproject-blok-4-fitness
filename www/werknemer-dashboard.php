<?php
require "database.php";

$sql = "SELECT * FROM workout";
$result = mysqli_query($conn, $sql);
$workouts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);

//tijd filter
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
    $niveaus = ['beginner', 'gevorderd', 'expert'];
    if (in_array($diff, $niveaus)) {
        $sql = "SELECT * FROM workout WHERE moeilijkheidsgraad = '$diff'";
        $result = mysqli_query($conn, $sql);
        $workouts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

//searchbar
if (isset($_GET['zoekbutton']) && !empty($_GET['search-workout'])) {
    $zoeken = mysqli_real_escape_string($conn, $_GET['search-workout']);
    $sql = "SELECT * FROM workout WHERE titel LIKE '%$zoeken%'";
    $result = mysqli_query($conn, $sql);
    $workouts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Werknemer dash</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "header.php"; ?>
    <main class="main-workouts">
        <div class="filters">
            <a href="?sort=">Normaal</a>
            <a href="?tijd=asc">kort > lang</a>
            <a href="?tijd=desc">lang > kort</a>
            <a href="?diff=beginner">beginner</a>
            <a href="?diff=gevorderd">gevorderd</a>
            <a href="?diff=expert">expert</a>
        </div>
        <div class="search ">
            <label for="search">Zoek voor een workout:</label>
            <form method="get">
                <input type="search" name="search-workout" id="search">
                <button type="submit" name="zoekbutton">Search</button>
            </form>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
            <details class="compact-collapsible">
                <summary>Maak een workout</summary>
                <div>
                    <form action="workout_toevoegen.php" method="post" enctype="multipart/form-data" class="register-form">
                        <label for="titel">Titel:</label>
                        <input type="text" name="titel" id="titel" required>

                        <label for="duur">Duur (uu:mm:ss):</label>
                        <input type="time" name="duur" id="duur" step="1" required>

                        <label for="beschrijving">Beschrijving:</label>
                        <textarea name="beschrijving" id="beschrijving" rows="3" required></textarea>

                        <label for="notitie">Notitie:</label>
                        <textarea name="notitie" id="notitie" rows="2"></textarea>

                        <label for="afbeelding">Afbeelding (URL):</label>
                        <input type="text" name="afbeelding" id="afbeelding">

                        <label for="toegevoegd_op">Toegevoegd op (datum):</label>
                        <input type="date" name="toegevoegd_op" id="toegevoegd_op" required>

                        <label for="moeilijkheidsgraad">Moeilijkheidsgraad:</label>
                        <select name="moeilijkheidsgraad" id="moeilijkheidsgraad" required>
                            <option value="beginner">Beginner</option>
                            <option value="gevorderd">Gevorderd</option>
                            <option value="expert">Expert</option>
                        </select>

                        <button type="submit">Opslaan</button>
                    </form>
                </div>
            </details>
            <details class="compact-collapsible">
                <summary>Workouts</summary>
                <div>
                    <div class="workout-section">
                        <?php foreach ($workouts_info as $workout) { ?>
                            <section class="workout">
                                <img class="image-workout" src="<?php echo $workout["afbeelding"]; ?>" alt="<?php echo $workout["afbeelding"]; ?>">
                                <div class="workout-text">
                                    <h1> <?php echo $workout["titel"]; ?></h1>
                                    <h2>Duur: <?php echo substr($workout["duur"], 0, 5); ?></h2>
                                    <p>📝 <?php echo $workout["beschrijving"]; ?></p>
                                    <p>📌 Notitie: <?php echo $workout["notitie"]; ?></p>
                                    <p>📌 Toegevoegd op: <?php echo $workout["toegevoegd_op"]; ?></p>
                                    <p>📌 Moeilijkheidsgraad: <?php echo $workout["moeilijkheidsgraad"]; ?></p>
                                </div>
                                <a class="workout-detail-button" href="workout_detail.php?workout_id=<?php echo $workout['workout_id']; ?>">Meer info</a>
                            </section>
                        <?php } ?>
                    </div>
                </div>
            </details>
            <details class="compact-collapsible">
                <summary>Leden</summary>
                <div>

                </div>
            </details>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>