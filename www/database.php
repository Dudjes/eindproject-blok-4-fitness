<?php
$dbhost = "mariadb";
$dbuser = "root";
$dbpass = "password";
$dbname = "Fitness";

$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}