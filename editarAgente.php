<?php
include("conector.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $idusuario = $_POST["idusuario"];
    $codigo = $_POST["codigo"];
    $especialidad = $_POST["especialidad"];
    $experiencia = $_POST["experiencia"];
    $zona = $_POST["zona"];
    $comision = $_POST["comision"];
    $estado = $_POST["estado"];
    $fecha = $_POST["fecha"];

    // Validación básica
    if (empty($idusuario) || empty($codigo) || empty($estado) || empty($fecha)) {
        echo "❌ Faltan datos obligatorios.";
        exit;
    }

    $sql = "UPDATE Agentes SET 
                IDUsuario=$idusuario,
                CodigoAgente='$codigo',
                Especialidad='$especialidad',
                Experiencia=" . ($experiencia !== "" ? $experiencia : "NULL") . ",
                ZonaAsignada='$zona',
                Comision=" . ($comision !== "" ? $comision : "NULL") . ",
                Estado='$estado',
                FechaRegistro='$fecha'
            WHERE IDAgente=$id";

    if (mysqli_query($conexion, $sql)) {
        echo "✅ Información del agente actualizada correctamente.";
    } else {
        echo "❌ Error al actualizar: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
