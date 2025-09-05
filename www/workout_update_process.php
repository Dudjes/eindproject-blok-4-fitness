<?php
require "database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['workout_id']; // Hidden input from your form

    // Fetch current workout
    $stmt_old = $conn->prepare("SELECT * FROM workout WHERE workout_id = ?");
    $stmt_old->bind_param("i", $id);
    $stmt_old->execute();
    $result_old = $stmt_old->get_result();
    $workout_old = $result_old->fetch_assoc();

    // Use old values if fields are empty
    $titel = !empty($_POST['titel']) ? $_POST['titel'] : $workout_old['titel'];
    $duur = !empty($_POST['duur']) ? (int)$_POST['duur'] : (int)$workout_old['duur'];
    $beschrijving = !empty($_POST['beschrijving']) ? $_POST['beschrijving'] : $workout_old['beschrijving'];
    $notitie = !empty($_POST['notitie']) ? $_POST['notitie'] : $workout_old['notitie'];
    $afbeelding = !empty($_POST['afbeelding']) ? $_POST['afbeelding'] : $workout_old['afbeelding'];
    $toegevoegd_op = !empty($_POST['toegevoegd_op']) ? $_POST['toegevoegd_op'] : $workout_old['toegevoegd_op'];
    $moeilijkheidsgraad = !empty($_POST['moeilijkheidsgraad']) ? $_POST['moeilijkheidsgraad'] : $workout_old['moeilijkheidsgraad'];

    // Update query using prepared statement
    $stmt_update = $conn->prepare("UPDATE workout 
        SET titel = ?, duur = ?, beschrijving = ?, notitie = ?, afbeelding = ?, toegevoegd_op = ?, moeilijkheidsgraad = ? 
        WHERE workout_id = ?");
    $stmt_update->bind_param(
        "sisssssi", 
        $titel, $duur, $beschrijving, $notitie, $afbeelding, $toegevoegd_op, $moeilijkheidsgraad, $id
    );

    if ($stmt_update->execute()) {
        echo "<p style='color:green;'>Workout succesvol bijgewerkt!</p>";
    } else {
        echo "<p style='color:red;'>Fout bij bijwerken van workout.</p>";
    }
}
?>