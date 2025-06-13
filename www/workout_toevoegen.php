<?php
require "database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lengte checks
    if(strlen($_POST['titel']) > 100){
        echo "<p style='color:red;'>Titel te lang</p>";
    }
    if(strlen($_POST['beschrijving']) > 1000){
        echo "<p style='color:red;'>Beschrijving te lang</p>";
    }
    if(strlen($_POST['notitie']) > 1000){
        echo "<p style='color:red;'>Notitie te lang</p>";
    }
    if(strlen($_POST['afbeelding']) > 2000){
        echo "<p style='color:red;'>Afbeelding te lang</p>";
    }
    if(strlen($_POST['moeilijkheidsgraad']) > 20){
        echo "<p style='color:red;'>Moeilijkheidsgraad te lang</p>";
    }

    // Vereiste velden checken
    $vereist = ['titel', 'duur', 'beschrijving', 'toegevoegd_op', 'moeilijkheidsgraad'];
    $errors = [];
    foreach ($vereist as $veld) {
        if (empty($_POST[$veld])) {
            $errors[] = $veld . " is vereist.";
        }
    }
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // Data ophalen
        $titel = $_POST['titel'];
        $duur = $_POST['duur'];
        $beschrijving = $_POST['beschrijving'];
        $notitie = $_POST['notitie'];
        $afbeelding = $_POST['afbeelding'];
        $toegevoegd_op = $_POST['toegevoegd_op'];
        $moeilijkheidsgraad = $_POST['moeilijkheidsgraad'];

        // Insert query
        $sql = "INSERT INTO workout (titel, duur, beschrijving, notitie, afbeelding, toegevoegd_op, moeilijkheidsgraad)
                VALUES ('$titel', '$duur', '$beschrijving', '$notitie', '$afbeelding', '$toegevoegd_op', '$moeilijkheidsgraad')";
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color:green;'>Workout succesvol toegevoegd!</p>";
        } else {
            echo "<p style='color:red;'>Fout bij toevoegen van workout.</p>";
        }
    }
}