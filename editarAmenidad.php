<?php
include("conector.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];

    if (empty($nombre)) {
        echo "❌ El nombre de la amenidad no puede estar vacío.";
        exit;
    }

    $sql = "UPDATE Amenidades SET Nombre='$nombre' WHERE IDAmenidad=$id";

    if (mysqli_query($conexion, $sql)) {
        echo "✅ Amenidad actualizada correctamente.";
    } else {
        echo "❌ Error al actualizar: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
