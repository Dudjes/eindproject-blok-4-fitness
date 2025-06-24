<?php
require "database.php";
error_reporting(0); // errors naar 0 
ini_set('display_errors', 0); // ini_set veranderd settings van php

if(strlen($_POST['firstname']) > 100){
    echo "<p style='color:red;'>firstname te lang</p>";
}
if(strlen($_POST['lastname']) > 100){
    echo "<p style='color:red;'>lastname te lang</p>";
}
if(strlen($_POST['email']) > 100){
    echo "<p style='color:red;'>email te lang</p>";
}
if(strlen($_POST['password']) > 100){
    echo "<p style='color:red;'>password te lang</p>";
}
if(strlen($_POST['username']) > 50){
    echo "<p style='color:red;'>username te lang</p>";
}
if(strlen($_POST['straat']) > 100){
    echo "<p style='color:red;'>straat te lang</p>";
}
if(strlen($_POST['huisnummer']) > 10){
    echo "<p style='color:red;'>huisnummer te lang</p>";
}
if(strlen($_POST['postcode']) > 6){
    echo "<p style='color:red;'>postcode te lang</p>";
}
if(strlen($_POST['stad']) > 100){
    echo "<p style='color:red;'>stad te lang</p>";
}
if(strlen($_POST['land']) > 100){
    echo "<p style='color:red;'>land te lang</p>";
}
if(strlen($_POST['telefoonnummer']) > 15){
    echo "<p style='color:red;'>telefoonnummer te lang</p>";
}
if(strlen($_POST['mobiel']) > 15){
    echo "<p style='color:red;'>mobiel te lang</p>";
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vereist = [
        'firstname', 'lastname', 'straat', 'huisnummer', 'username', 'email',
        'postcode', 'stad', 'land', 'telefoonnummer', 'mobiel', 'rol', 'password'
    ];
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

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $straat = $_POST['straat'];
        $huisnummer = $_POST['huisnummer'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $postcode = $_POST['postcode'];
        $stad = $_POST['stad'];
        $land = $_POST['land'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $mobiel = $_POST['mobiel'];
        $rol = $_POST['rol'];
        $password = $_POST['password'];

        //inserten naar gebruiker en adres (2 tabbelen)
        $sql1 = "INSERT INTO gebruiker (firstname, lastname, email, password, username, rol)
        VALUES ('$firstname', '$lastname', '$email', '$password', '$username', '$rol')";
        if (mysqli_query($conn, $sql1)) {
            $gebruikerid = mysqli_insert_id($conn);
            
            $sql2 = "INSERT INTO adres (straat, huisnummer, postcode, stad, land, telefoonnummer, mobiel, gebruikerid)
            VALUES ('$straat', '$huisnummer', '$postcode', '$stad', '$land', '$telefoonnummer', '$mobiel', '$gebruikerid')";
            if (mysqli_query($conn, $sql2)) {
                echo "<p style='color:green;'>Account succesvol aangemaakt!</p>";
            } else {
                echo "<p style='color:red;'>Fout bij adres toevoegen.</p>";
            }
        } else {
            echo "<p style='color:red;'>Fout bij gebruiker toevoegen.</p>";
        }
    }
}