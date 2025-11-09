<?php
include("conector.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $idusuario = $_POST["idusuario"];
    $idagente = $_POST["idagente"];
    $idpropiedad = $_POST["idpropiedad"];
    $puntuacion = $_POST["puntuacion"];
    $comentario = $_POST["comentario"];
    $fecha = $_POST["fecha"];

    // Validaciones básicas
    if (empty($idusuario) || empty($puntuacion) || empty($fecha)) {
        echo "❌ Faltan datos obligatorios.";
        exit;
    }

    if ($puntuacion < 1 || $puntuacion > 5) {
        echo "❌ La puntuación debe estar entre 1 y 5.";
        exit;
    }

    $sql = "UPDATE Valoraciones SET 
                IDUsuario=$idusuario,
                IDAgente=" . ($idagente !== "" ? $idagente : "NULL") . ",
                IDPropiedad=" . ($idpropiedad !== "" ? $idpropiedad : "NULL") . ",
                Puntuacion=$puntuacion,
                Comentario='$comentario',
                Fecha='$fecha'
            WHERE IDValoracion=$id";

    if (mysqli_query($conexion, $sql)) {
        echo "✅ Valoración actualizada correctamente.";
    } else {
        echo "❌ Error al actualizar: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
