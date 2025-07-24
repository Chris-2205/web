<?php
$conn = new mysqli("localhost", "root", "", "codequest");
if ($conn->connect_error) {
    die("Error DB: " . $conn->connect_error);
}
?>
