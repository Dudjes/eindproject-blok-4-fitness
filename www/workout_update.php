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

$id = $_GET['workout_id'];

$sql = "SELECT * FROM workout WHERE workout_id = $id";
$result = mysqli_query($conn, $sql);
$workout = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>workout update</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .register-form {
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 12px;
            border: 1px solid #d4d1d1;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            display: flex;
            flex-direction: column;
            align-items: stretch;
            padding: 2rem 1.5rem;
            gap: 1rem;
        }
        .image-workout {
            height: 25vw;
            width: 100%;
            border-radius: 12px;
            margin-bottom: 2%;
            border: white 2px solid;
        }
        .register-form button {
            background: #0074d9;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 2rem;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php require "header.php"; ?>
    <div class="register">
        <div>
            <img src="<?php echo $workout["afbeelding"]; ?>" alt="workout" class="image-workout">
        </div>
        <form action="workout_update_process.php" method="POST" class="register-form">
            <input type="hidden" name="workout_id" value="<?php echo $workout['workout_id']; ?>">
            <div class="register-row">
                <input type="text" name="titel" placeholder="<?php echo $workout["titel"]; ?>">
            </div>
            <div class="register-row">
                <input type="text" name="duur" placeholder="<?php echo substr($workout["duur"],0,5); ?>">
                <input type="text" name="moeilijkheidsgraad" placeholder="<?php echo $workout["moeilijkheidsgraad"]; ?>">
            </div>
            <div class="register-row">
                <input type="text" name="beschrijving" placeholder="<?php echo $workout["beschrijving"]; ?>">
                <input type="text" name="notitie" placeholder="<?php echo $workout["notitie"]; ?>">
            </div>
            <div class="register-row">
                <input type="text" name="afbeelding" placeholder="<?php echo $workout["afbeelding"]; ?>">
                <input type="text" name="toegevoegd_op" placeholder="<?php echo $workout["toegevoegd_op"]; ?>">
            </div>
            <button type="submit" class="update-button">Update</button>
        </form>
    </div>
</body>
</html>