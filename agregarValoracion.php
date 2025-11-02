<?php
include('conector.php');
$Con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = intval($_POST['idUsuario']);
    $idAgente = ($_POST['idAgente'] == "") ? NULL : intval($_POST['idAgente']);
    $idPropiedad = intval($_POST['idPropiedad']);
    $puntuacion = intval($_POST['puntuacion']);
    $comentario = trim($_POST['comentario']);
    $fecha = date("Y-m-d");

    // Validaciones
    if (empty($idUsuario) || empty($idPropiedad) || empty($puntuacion)) {
        die("Debes seleccionar usuario, propiedad y puntuación.");
    }
    if ($puntuacion < 1 || $puntuacion > 5) {
        die("La puntuación debe estar entre 1 y 5.");
    }

    // Insertar datos (con el nuevo campo Fecha)
    $sql = "INSERT INTO Valoraciones (IDUsuario, IDAgente, IDPropiedad, Puntuacion, Comentario, Fecha)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($Con, $sql);
    mysqli_stmt_bind_param($stmt, "iiiiss", $idUsuario, $idAgente, $idPropiedad, $puntuacion, $comentario, $fecha);

    if (mysqli_stmt_execute($stmt)) {
        echo "Valoración registrada correctamente.";
    } else {
        echo "Error al guardar: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}

desconectar($Con);
?>
