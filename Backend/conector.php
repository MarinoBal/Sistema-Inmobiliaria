<?php
$server = "127.0.0.1";
$user = "root";
$pwd = "";
$db = "inmobiliaria";

$conn = new mysqli($server, $user, $pwd, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
