<?php
include("conector.php"); // tu archivo de conexión

if (isset($_GET['IDPropiedad'])) {
    $IDPropiedad = $_GET['IDPropiedad'];

    $Con = conectar();

    // Por seguridad, verifica si existe
    $checkSQL = "SELECT * FROM Propiedades WHERE IDPropiedad = '$IDPropiedad';";
    $checkResult = ejecutar($Con, $checkSQL);

    if (mysqli_num_rows($checkResult) > 0) {
        // Eliminar la propiedad
        $SQL = "DELETE FROM Propiedades WHERE IDPropiedad = '$IDPropiedad';";
        $resultSet = ejecutar($Con, $SQL);
        $affectedRows = mysqli_affected_rows($Con);

        if ($affectedRows > 0) {
            echo "✅ Propiedad eliminada correctamente.<br>";
            echo "Filas afectadas: $affectedRows<br>";
        } else {
            echo "⚠️ No se pudo eliminar la propiedad.<br>";
        }
    } else {
        echo "❌ No existe ninguna propiedad con ese ID.<br>";
    }

    desconectar($Con);
} else {
    echo "Por favor, ingrese un ID válido.";
}
?>
