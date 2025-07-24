<?php
require_once "db.php";

$username = $_GET['username'];
$room = $_GET['room'];

$res = $conn->query("SELECT level FROM progress WHERE username='$username'");
$level = $res->fetch_assoc()['level'] ?? 1;

$resUser = $conn->query("SELECT position FROM users WHERE username='$username' AND room='$room'");
$position = $resUser->fetch_assoc()['position'] ?? 1;

$resLvl = $conn->query("SELECT part1, part2 FROM levels WHERE level_id=$level");
$l = $resLvl->fetch_assoc();

$challenge = ($position == 1) 
  ? "Tu compañero tiene: " . $l['part2'] 
  : "Tu compañero tiene: " . $l['part1'];

echo json_encode(["challenge" => $challenge, "level" => $level]);
?>
