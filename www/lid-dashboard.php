<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['user_rol'] != 'lid') {
    header('Location: index.php');
    exit;
}
require "database.php";
$id = $_SESSION['user_id'] ?? null;

//lid info
$sql = "SELECT gebruiker.*, adres.* 
        FROM gebruiker 
        JOIN adres ON gebruiker.gebruikerid = adres.adresid 
        WHERE gebruiker.gebruikerid = '$id'";
$result = mysqli_query($conn, $sql);
$lid_info = mysqli_fetch_assoc($result);

//aantal workouts
$count_sql = "SELECT COUNT(*) AS totaal FROM workout";
$count_result = mysqli_query($conn, $count_sql);
$aantal_workouts = mysqli_fetch_assoc($count_result)['totaal'];

//verschillende workout niveaus
$diff_sql = "SELECT moeilijkheidsgraad, COUNT(*) AS aantal FROM workout GROUP BY moeilijkheidsgraad";
$diff_result = mysqli_query($conn, $diff_sql);

$workouts_per_diff = [];
while ($row = mysqli_fetch_assoc($diff_result)) {
    $workouts_per_diff[$row['moeilijkheidsgraad']] = $row['aantal'];
}
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
            <a href="logout.php">Logout</a>
        </div>
        <div class="lid-info">
            <h1>Uw gegevens</h1>
            <div class="lid-info-row">
                <div class="lid-info-block">
                    <h2>Persoonlijk</h2>
                    <ul>
                        <li><p>Naam: <?php echo $lid_info['firstname'] . " " . $lid_info['lastname']; ?></p></li>
                        <li><p>Email: <?php echo $lid_info['email']; ?></p></li>
                        <li><p>Username: <?php echo $lid_info['username']; ?></p></li>
                        <li><p>Rol: <?php echo $lid_info['rol']; ?></p></li>
                    </ul>
                </div>
                <div class="lid-info-block">
                    <h2>Adres</h2>
                    <ul>
                        <li><p>Straat: <?php echo $lid_info['straat'] . " " . $lid_info['huisnummer']; ?></p></li>
                        <li><p>Postcode: <?php echo $lid_info['postcode']; ?></p></p></li>
                        <li><p>Stad: <?php echo $lid_info['stad']; ?></p></li>
                        <li><p>Land: <?php echo $lid_info['land']; ?></p></li>
                    </ul>
                </div>
                <div class="lid-info-block">
                    <h2>Contact</h2>
                    <ul>
                        <li><p>Telefoonnummer: <?php echo $lid_info['telefoonnummer']; ?></p></li>
                        <li><p>Mobiel: <?php echo $lid_info['mobiel']; ?></p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="lid-info">
            <div class="lid-dash-infodb">
                <h1>Database informatie:</h1>
                <div class="lid-info-block">
                    <h2>Workouts</h2>
                    <ul>
                        <li><p>Er zijn nu <?php echo $aantal_workouts;?> verschillende workouts!</p></li>
                        <li><p>Allemaal met top kwaliteit voor u gekozen</p></li>
                    </ul>
                </div>
                <div class="lid-info-block">
                    <h2>Workouts per moeilijkheidsgraad</h2>
                    <ul>
                        <li><p>Beginner: <?php echo $workouts_per_diff['beginner'] ?? 0; ?></p></li>
                        <li><p>Gevorderd: <?php echo $workouts_per_diff['gevorderd'] ?? 0; ?></p></li>
                        <li><p>Expert: <?php echo $workouts_per_diff['expert'] ?? 0; ?></p></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>