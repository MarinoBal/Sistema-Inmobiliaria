<?php
include("conector.php"); // tu archivo de conexión a la BD

if (isset($_GET['IDCita'])) {
    $IDCita = $_GET['IDCita'];

    $Con = conectar();

    // SQL para eliminar una cita específica
    $SQL = "DELETE FROM Citas WHERE IDCita = '$IDCita';";
    $resultSet = ejecutar($Con, $SQL);
    $affectedRows = mysqli_affected_rows($Con);

    if ($affectedRows > 0) {
        echo "✅ Cita eliminada correctamente.<br>";
        echo "Filas afectadas: $affectedRows<br>";
    } else {
        echo "⚠️ No se encontró ninguna cita con ese ID.<br>";
    }

    desconectar($Con);
} else {
    echo "Por favor, ingrese un ID válido.";
}
?>
