<?php
include('conector.php');
$Con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = intval($_POST['idUsuario']);
    $idPropiedad = intval($_POST['idPropiedad']);
    $duracion = ($_POST['duracion'] == "") ? NULL : intval($_POST['duracion']);
    $fechaHora = date("Y-m-d H:i:s"); // Guarda fecha y hora actuales

    if (empty($idUsuario) || empty($idPropiedad)) {
        die("Debes seleccionar un usuario y una propiedad.");
    }

    $sql = "INSERT INTO Historial (IDUsuario, IDPropiedad, FechaHora, DuracionSegundos)
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($Con, $sql);
    mysqli_stmt_bind_param($stmt, "iisi", $idUsuario, $idPropiedad, $fechaHora, $duracion);

    if (mysqli_stmt_execute($stmt)) {
        echo "Registro de historial agregado correctamente.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}

desconectar($Con);
?>
