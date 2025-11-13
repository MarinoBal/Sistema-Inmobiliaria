<?php
include("conector.php"); // tu archivo de conexión

if (isset($_GET['IDAmenidad'])) {
    $IDAmenidad = $_GET['IDAmenidad'];

    $Con = conectar();

    // Comprobar si existe
    $checkSQL = "SELECT * FROM Amenidades WHERE IDAmenidad = '$IDAmenidad';";
    $checkResult = ejecutar($Con, $checkSQL);

    if (mysqli_num_rows($checkResult) > 0) {
        // Eliminar la amenidad
        $SQL = "DELETE FROM Amenidades WHERE IDAmenidad = '$IDAmenidad';";
        $resultSet = ejecutar($Con, $SQL);
        $affectedRows = mysqli_affected_rows($Con);

        if ($affectedRows > 0) {
            echo "✅ Amenidad eliminada correctamente.<br>";
            echo "Filas afectadas: $affectedRows<br>";
        } else {
            echo "⚠️ No se pudo eliminar la amenidad.<br>";
        }
    } else {
        echo "❌ No existe ninguna amenidad con ese ID.<br>";
    }

    desconectar($Con);
} else {
    echo "Por favor, ingrese un ID válido.";
}
?>
