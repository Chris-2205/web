<?php
require_once "db.php";

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$room = $data['room'];
$position = intval($data['position']);
$answer = trim($data['solution']);

// Obtener nivel
$res = $conn->query("SELECT level FROM progress WHERE username='$username'");
$level = $res->fetch_assoc()['level'] ?? 1;

// Obtener respuesta correcta
$resLvl = $conn->query("SELECT part1, part2 FROM levels WHERE level_id=$level");
$lvl = $resLvl->fetch_assoc();

$correct = $position === 1 ? $lvl['part1'] : $lvl['part2'];
$correct = strtolower(preg_replace('/\s+/', '', $correct));
$userAns = strtolower(preg_replace('/\s+/', '', $answer));

if ($userAns === $correct) {
    $conn->query("UPDATE progress SET level = level + 1, coins = coins + 5 WHERE username='$username'");
    echo json_encode(["success" => true, "message" => "¡Respuesta correcta! Avanzas al siguiente nivel."]);
} else {
    echo json_encode(["success" => false, "message" => "Respuesta incorrecta."]);
}
?>
