<?php
if (!isset($_POST['username']) || !isset($_POST['wachtwoord'])) {
    header('Location: login.php');
    exit;
}
$username = $_POST['username'];
$wachtwoord = $_POST['wachtwoord'];

require "database.php";

$sql = "SELECT * FROM gebruiker WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (is_array($user)) {
    if($wachtwoord == $user['wachtwoord']) {
        session_start();
        $_SESSION['user_id'] = $user['gebruiker_id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_username'] = $user['username'];
        $_SESSION['user_rol'] = $user['rol'];
        if ($user['rol'] == 'bezoeker') {
            header('Location: index.php');
            exit;
        } else if ($user['rol'] == 'lid') {
            header('Location: lid-dashboard.php');
            exit;
        } else if ($user['rol'] == 'werknemer') {
            header('Location: werknemer-dashboard.php');
            exit;
        }
        exit;
    }
}
header('Location: login.php');
exit;
