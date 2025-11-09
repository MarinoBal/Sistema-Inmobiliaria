<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $rol = $_POST['rol']; // Cliente, Asesor, Admin
    $fecha = date("Y-m-d");

    $sql = "INSERT INTO Usuarios (NombreCompleto, Correo, Telefono, Contrasena, Rol, FechaRegistro)
            VALUES ('$nombre', '$correo', '$telefono', '$contrasena', '$rol', '$fecha')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Usuario agregado correctamente";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
$conn->close();
?>
