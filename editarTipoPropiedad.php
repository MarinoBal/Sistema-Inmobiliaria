<?php
include("conector.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];

    // Validar datos
    if (empty($nombre)) {
        echo "El nombre del tipo de propiedad no puede estar vacío.";
        exit;
    }

    $sql = "UPDATE TiposPropiedad SET Nombre='$nombre' WHERE IDTipo=$id";

    if (mysqli_query($conexion, $sql)) {
        echo "Tipo de propiedad actualizado correctamente.";
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
