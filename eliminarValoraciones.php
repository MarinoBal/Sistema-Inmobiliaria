<?php
include("conector.php"); 

if (isset($_GET['IDValoracion'])) {
    $IDValoracion = $_GET['IDValoracion'];

    $Con = conectar();

    $SQL = "DELETE FROM Valoraciones WHERE IDValoracion = '$IDValoracion';";
    $resultSet = ejecutar($Con, $SQL);
    $affectedRows = mysqli_affected_rows($Con);

    if ($affectedRows > 0) {
        echo "✅ Valoración eliminada correctamente.<br>";
        echo "Filas afectadas: $affectedRows<br>";
    } else {
        echo "⚠️ No se encontró ninguna valoración con ese ID.<br>";
    }

    desconectar($Con);
} else {
    echo "Por favor, ingrese un ID válido.";
}
?>
