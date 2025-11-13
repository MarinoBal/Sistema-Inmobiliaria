<?php
include("conector.php"); // tu archivo de conexión a la BD

if (isset($_GET['IDPreferencia'])) {
    $IDPreferencia = $_GET['IDPreferencia'];

    $Con = conectar();

    // Eliminar la preferencia específica
    $SQL = "DELETE FROM PreferenciasCliente WHERE IDPreferencia = '$IDPreferencia';";
    $resultSet = ejecutar($Con, $SQL);
    $affectedRows = mysqli_affected_rows($Con);

    if ($affectedRows > 0) {
        echo "✅ Preferencia eliminada correctamente.<br>";
        echo "Filas afectadas: $affectedRows<br>";
    } else {
        echo "⚠️ No se encontró ninguna preferencia con ese ID.<br>";
    }

    desconectar($Con);
} else {
    echo "Por favor, ingrese un ID válido.";
}
?>
