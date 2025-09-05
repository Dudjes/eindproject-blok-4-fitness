<?php
require "database.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['user_rol'] != 'werknemer') {
    header('Location: bezoeker-dashboard.php');
    exit;
}


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
                <div class="aanmaak-workout">
                    <form action="workout_toevoegen.php" method="post" class="register-form">
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
                    <table class="workout-table">
                        <thead>
                            <tr>
                                <th>Afbeelding</th>
                                <th>Titel</th>
                                <th>Duur</th>
                                <th>Beschrijving</th>
                                <th>Notitie</th>
                                <th>Toegevoegd op</th>
                                <th>Moeilijkheidsgraad</th>
                                <th>Meer info</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($workouts_info as $workout) { ?>
                                <tr>
                                    <td>
                                        <img class="image-workout" src="<?php echo $workout["afbeelding"]; ?>" alt="<?php echo $workout["afbeelding"]; ?>" style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                                    </td>
                                    <td><?php echo $workout["titel"]; ?></td>
                                    <td><?php echo substr($workout["duur"], 0, 5); ?></td>
                                    <td><?php echo $workout["beschrijving"]; ?></td>
                                    <td><?php echo $workout["notitie"]; ?></td>
                                    <td><?php echo $workout["toegevoegd_op"]; ?></td>
                                    <td><?php echo $workout["moeilijkheidsgraad"]; ?></td>
                                    <td>
                                        <a class="workout-detail-button" href="workout_detail.php?workout_id=<?php echo $workout['workout_id']; ?>">Meer info</a>
                                    </td>
                                    <td>
                                        <a class="workout-detail-button" href="workout_update.php?workout_id=<?php echo $workout['workout_id']; ?>">Update</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
                            </div>
                            <a href="gebruiker_dash.php?id=<?php echo $account['gebruikerid']; ?>" class="detail-button">Detail pagina</a>
                        </div>
                    <?php } ?>
                </div>
            </details>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>