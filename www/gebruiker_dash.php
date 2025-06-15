<?php
require "database.php";
$id = $_GET['id'];

//gebruiker info
$sql = "SELECT gebruiker.*, adres.*
        FROM gebruiker
        JOIN adres ON gebruiker.gebruikerid = adres.gebruikerid
        WHERE gebruiker.gebruikerid = $id";
$result = mysqli_query($conn, $sql);
$gebruiker_info = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lid dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <main class="main-workouts">
        <div class="logout">
            <a href="werknemer-dashboard.php">Terug</a>
        </div>
        <div class="lid-info">
            <h1>Gebuiker gegevens</h1>
            <div class="lid-info-row">
                <div class="lid-info-block">
                    <h2>Persoonlijk</h2>
                    <ul>
                        <li><p>Naam: <?php echo $gebruiker_info['firstname'] . " " . $gebruiker_info['lastname']; ?></p></li>
                        <li><p>Email: <?php echo $gebruiker_info['email']; ?></p></li>
                        <li><p>Username: <?php echo $gebruiker_info['username']; ?></p></li>
                        <li><p>Rol: <?php echo $gebruiker_info['rol']; ?></p></li>
                    </ul>
                </div>
                <div class="lid-info-block">
                    <h2>Adres</h2>
                    <ul>
                        <li><p>Straat: <?php echo $gebruiker_info['straat'] . " " . $gebruiker_info['huisnummer']; ?></p></li>
                        <li><p>Postcode: <?php echo $gebruiker_info['postcode']; ?></p></p></li>
                        <li><p>Stad: <?php echo $gebruiker_info['stad']; ?></p></li>
                        <li><p>Land: <?php echo $gebruiker_info['land']; ?></p></li>
                    </ul>
                </div>
                <div class="lid-info-block">
                    <h2>Contact</h2>
                    <ul>
                        <li><p>Telefoonnummer: <?php echo $gebruiker_info['telefoonnummer']; ?></p></li>
                        <li><p>Mobiel: <?php echo $gebruiker_info['mobiel']; ?></p></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>