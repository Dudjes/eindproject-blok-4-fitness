<?php
require "database.php";

$sql = "SELECT * FROM workout";
$result = mysqli_query($conn, $sql);
$workouts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT gebruiker.*, lid.*, medewerker.* 
        FROM gebruiker
        JOIN lid ON gebruiker.gebruikerid = lid.gebruikerid
        JOIN medewerker ON  gebruiker.gebruikerid = medewerker.gebruikerid";
$result = mysqli_query($conn, $sql);
$accounts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);


//searchbar
if (!empty($_GET['search-workout'])) {
    $zoeken = mysqli_real_escape_string($conn, $_GET['search-workout']);

    //workout
    $sql = "SELECT * FROM workout WHERE LOWER(titel) LIKE '%$zoeken%'";
    $result = mysqli_query($conn, $sql);
    $workouts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);


    //account
    $sql = "SELECT gebruiker.*, lid.*, medewerker.* 
            FROM gebruiker
            JOIN lid ON gebruiker.gebruikerid = lid.gebruikerid
            JOIN medewerker ON gebruiker.gebruikerid = medewerker.gebruikerid
            WHERE LOWER(gebruiker.firstname) LIKE LOWER('%$zoeken%')
               OR LOWER(gebruiker.lastname) LIKE LOWER('%$zoeken%')
               OR LOWER(gebruiker.email) LIKE LOWER('%$zoeken%')";
    $result = mysqli_query($conn, $sql);
    $accounts_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <div class="search ">
            <form method="get">
                <input type="search" name="search-workout" id="search">
                <button type="submit">Search</button>
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
                <summary>Accounts</summary>
                <div class="accounts">
                    <?php foreach ($accounts_info as $account) { ?>
                        <div class="account">
                            <h2><?php echo $account['firstname']; ?> <?php echo $account['lastname']; ?></h2>
                            <div class="account-info">
                                <ul>
                                    <li>Email: <?php echo $account['email']; ?></li>
                                    <li>Username: <?php echo $account["username"]; ?></li>
                                </ul>
                                <ul>
                                    <li>Rol: <?php echo $account['rol']; ?></li>
                                </ul>
                                <ul>
                                    <?php if ($account['rol'] == 'mederwerker') { ?>
                                        <li>Begonnen werken:<?php echo $account['start_date']; ?></li>
                                        <li>Titel: <?php echo $account['job_title']; ?></li>
                                    <?php } ?>
                                    <?php if ($account['rol'] == 'lid') { ?>
                                        <li>Laatste login: <?php echo $account['last_login_date']; ?></li>
                                        <li>id: <?php echo $account['gebruikerid']; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </details>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>