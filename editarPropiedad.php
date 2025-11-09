<?php
include("conector.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $direccion = $_POST["direccion"];
    $ciudad = $_POST["ciudad"];
    $colonia = $_POST["colonia"];
    $superficie = $_POST["superficie"];
    $terreno = $_POST["terreno"];
    $habitaciones = $_POST["habitaciones"];
    $banos = $_POST["banos"];
    $estacionamientos = $_POST["estacionamientos"];
    $estado = $_POST["estado"];
    $fecha = $_POST["fecha"];
    $idtipo = $_POST["idtipo"];
    $idasesor = $_POST["idasesor"];

    // Validación básica
    if (empty($titulo) || empty($direccion) || empty($ciudad) || empty($estado)) {
        echo "❌ Faltan datos obligatorios.";
        exit;
    }

    $sql = "UPDATE Propiedades SET 
                Titulo='$titulo',
                Descripcion='$descripcion',
                Precio=$precio,
                Direccion='$direccion',
                Ciudad='$ciudad',
                Colonia='$colonia',
                Superficie=$superficie,
                Terreno=$terreno,
                Habitaciones=$habitaciones,
                Banos=$banos,
                Estacionamientos=$estacionamientos,
                Estado='$estado',
                FechaPublicacion='$fecha',
                IDTipo=$idtipo,
                IDAsesor=$idasesor
            WHERE IDPropiedad=$id";

    if (mysqli_query($conexion, $sql)) {
        echo "✅ Propiedad actualizada correctamente.";
    } else {
        echo "❌ Error al actualizar: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
