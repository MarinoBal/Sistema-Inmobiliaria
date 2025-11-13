<?php
include("conector.php"); // tu archivo de conexión

if (isset($_GET['IDAgente'])) {
    $IDAgente = $_GET['IDAgente'];

    $Con = conectar();

    // SQL para eliminar al agente
    $SQL = "DELETE FROM Agentes WHERE IDAgente = '$IDAgente';";
    $resultSet = ejecutar($Con, $SQL);
    $affectedRows = mysqli_affected_rows($Con);

    if ($affectedRows > 0) {
        echo "✅ Agente eliminado correctamente.<br>";
        echo "Filas afectadas: $affectedRows<br>";
    } else {
        echo "⚠️ No se encontró ningún agente con ese ID.<br>";
    }

    desconectar($Con);
} else {
    echo "Por favor, ingrese un ID válido.";
}
?>
