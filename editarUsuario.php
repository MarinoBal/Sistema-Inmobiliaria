<?php
include("conector.php"); // tu archivo de conexión
$conexion = conectar();  // Conexión inicializada correctamente

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"];

    // Si se cambió la contraseña, la encriptamos
    if (!empty($contrasena)) {
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = "UPDATE Usuarios 
                SET NombreCompleto='$nombre', Correo='$correo', Telefono='$telefono', 
                    Contrasena='$contrasenaHash', Rol='$rol' 
                WHERE IDUsuario=$id";
    } else {
        $sql = "UPDATE Usuarios 
                SET NombreCompleto='$nombre', Correo='$correo', Telefono='$telefono', 
                    Rol='$rol' 
                WHERE IDUsuario=$id";
    }

    if (mysqli_query($conexion, $sql)) {
        echo "✅ Usuario actualizado correctamente.";
    } else {
        echo "❌ Error al actualizar: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
