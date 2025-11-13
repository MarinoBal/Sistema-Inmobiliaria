<?php
include("conector.php"); // tu archivo de conexión a la base de datos

if (isset($_GET['IDUsuario'])) {
    $IDUsuario = $_GET['IDUsuario'];

    $Con = conectar();

    // Verificar si el usuario existe
    $checkSQL = "SELECT * FROM Usuarios WHERE IDUsuario = '$IDUsuario';";
    $checkResult = ejecutar($Con, $checkSQL);

    if (mysqli_num_rows($checkResult) > 0) {
        // Eliminar usuario
        $SQL = "DELETE FROM Usuarios WHERE IDUsuario = '$IDUsuario';";
        $resultSet = ejecutar($Con, $SQL);
        $affectedRows = mysqli_affected_rows($Con);

        if ($affectedRows > 0) {
            echo "✅ Usuario eliminado correctamente.<br>";
            echo "Filas afectadas: $affectedRows<br>";
        } else {
            echo "⚠️ No se pudo eliminar el usuario.<br>";
        }
    } else {
        echo "❌ No existe ningún usuario con ese ID.<br>";
    }

    desconectar($Con);
} else {
    echo "Por favor, ingrese un ID válido.";
}
?>
