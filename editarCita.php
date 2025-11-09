<?php
include("conector.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $idusuario = $_POST["idusuario"];
    $idpropiedad = $_POST["idpropiedad"];
    $idasesor = $_POST["idasesor"];
    $fecha = $_POST["fecha"];
    $estado = $_POST["estado"];

    if (empty($idusuario) || empty($idpropiedad) || empty($idasesor) || empty($fecha) || empty($estado)) {
        echo "❌ Faltan datos obligatorios.";
        exit;
    }

    $sql = "UPDATE Citas SET 
                IDUsuario=$idusuario,
                IDPropiedad=$idpropiedad,
                IDAsesor=$idasesor,
                FechaCita='$fecha',
                Estado='$estado'
            WHERE IDCita=$id";

    if (mysqli_query($conexion, $sql)) {
        echo "✅ Cita actualizada correctamente.";
    } else {
        echo "❌ Error al actualizar: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
