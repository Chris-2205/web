<?php
session_start();
require_once "db.php";

$username = $_POST['username'];
$room = $_POST['room'];
$position = intval($_POST['position']);

// Si ya existe en esta sala, reutilizar posición
$res = $conn->query("SELECT * FROM users WHERE username='$username' AND room='$room'");
if ($res->num_rows > 0) {
    $position = $res->fetch_assoc()['position'];
} else {
    $conn->query("INSERT INTO users (username, room, position) VALUES ('$username', '$room', $position)");
}

// Asegurar progreso
$resProg = $conn->query("SELECT * FROM progress WHERE username='$username'");
if ($resProg->num_rows == 0) {
    $conn->query("INSERT INTO progress (username, level, coins) VALUES ('$username', 1, 0)");
}

// Guardar sesión
$_SESSION['username'] = $username;
$_SESSION['room'] = $room;
$_SESSION['position'] = $position;

header("Location: ../game.php");
exit();
?>
