<?php
session_start();

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header('Location: login.php');
    exit;
}

require "database.php";

$username = $_POST['username'];
$wachtwoord = $_POST['password'];

$sql = "SELECT * FROM gebruiker WHERE username = :username LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute(["username" => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if ($user && $wachtwoord === $user['password']) {
    $_SESSION['user_id'] =        $user['gebruikerid'];
    $_SESSION['user_email'] =     $user['email'];
    $_SESSION['user_username'] =  $user['username'];
    $_SESSION['user_rol']=        $user['rol'];

    switch ($user['rol']) {
        case 'bezoeker':
            header('Location: index.php');
            break;
        case 'lid':
            header('Location: lid-dashboard.php?id=' . $user['gebruikerid']);
            break;
        case 'werknemer':
            header('Location: werknemer-dashboard.php');
            break;
        default:
            header('Location: index.php');
    }
    exit;

}

// fallback if login fails
header('Location: login.php?error=1');
exit;
