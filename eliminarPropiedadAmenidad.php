<?php
include("conector.php"); 

if (isset($_GET['IDPropiedad']) && isset($_GET['IDAmenidad'])) {
    $IDPropiedad = $_GET['IDPropiedad'];
    $IDAmenidad = $_GET['IDAmenidad'];

    $Con = conectar();

    // Eliminar la relación específica
    $SQL = "DELETE FROM PropiedadAmenidad 
            WHERE IDPropiedad = '$IDPropiedad' AND IDAmenidad = '$IDAmenidad';";

    $resultSet = ejecutar($Con, $SQL);
    $affectedRows = mysqli_affected_rows($Con);

    if ($affectedRows > 0) {
        echo "✅ Relación Propiedad-Amenidad eliminada correctamente.<br>";
        echo "Filas afectadas: $affectedRows<br>";
    } else {
        echo "⚠️ No se encontró ninguna relación con esos datos.<br>";
    }

    desconectar($Con);
} else {
    echo "Por favor, ingrese ambos ID.";
}
?>
