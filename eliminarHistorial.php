<?php
include("conector.php"); // tu archivo de conexión

if (isset($_GET['IDHistorial'])) {
    $IDHistorial = $_GET['IDHistorial'];

    $Con = conectar();

    // Eliminar el registro por ID
    $SQL = "DELETE FROM Historial WHERE IDHistorial = '$IDHistorial';";
    $resultSet = ejecutar($Con, $SQL);
    $affectedRows = mysqli_affected_rows($Con);

    if ($affectedRows > 0) {
        echo "✅ Registro del historial eliminado correctamente.<br>";
        echo "Filas afectadas: $affectedRows<br>";
    } else {
        echo "⚠️ No se encontró ningún registro con ese ID.<br>";
    }

    desconectar($Con);
} else {
    echo "Por favor, ingrese un ID válido.";
}
?>
