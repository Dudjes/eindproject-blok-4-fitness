<?php
session_start();

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header('Location: login.php');
    exit;
}

require "database.php";

$username = $_POST['username'];
$wachtwoord = $_POST['password'];

$sql = "SELECT * FROM gebruiker WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);


if ($user && $wachtwoord === $user['password']) {
    $_SESSION['user_id'] = $user['gebruikerid'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_username'] = $user['username'];
    $_SESSION['user_rol'] = $user['rol'];

    if ($user['rol'] == 'bezoeker') {
        header('Location: index.php');
        exit;
    } elseif ($user['rol'] == 'lid') {
        header('Location: lid-dashboard.php?id=' . $user['gebruikerid']);
        exit;
    } elseif ($user['rol'] == 'werknemer') {
        header('Location: werknemer-dashboard.php');
        exit;
    }
}

// fallback if login fails
header('Location: login.php?error=1');
exit;
