<?php
session_start();
if (!isset($_SESSION['username'], $_SESSION['room'], $_SESSION['position'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CodeQuest: Juego</title>
  <link rel="stylesheet" href="css/style2.css">
  <script>
    const username = "<?php echo $_SESSION['username']; ?>";
    const room = "<?php echo $_SESSION['room']; ?>";
    const position = <?php echo $_SESSION['position']; ?>;
  </script>
</head>
<body>
  <h2>Jugador <?php echo $_SESSION['position']; ?> - <?php echo $_SESSION['username']; ?></h2>
  <div id="challenge">Cargando reto...</div>
  <input type="text" id="solution" placeholder="Tu código aquí">
  <button onclick="submitSolution()">Enviar</button>
  <div id="status"></div>

  <script src="js/game.js"></script>
</body>
</html>
