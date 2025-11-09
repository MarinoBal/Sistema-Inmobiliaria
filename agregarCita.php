<?php
include('conector.php');
$Con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST['idUsuario'];
    $idPropiedad = $_POST['idPropiedad'];
    $idAsesor = $_POST['idAsesor'];
    $fechaCita = $_POST['fechaCita'];
    $estado = $_POST['estado'];

    // Validaciones básicas
    if (empty($idUsuario) || empty($idPropiedad) || empty($idAsesor) || empty($fechaCita)) {
        die("Faltan datos obligatorios para registrar la cita.");
    }

    // Insertar la cita de forma segura
    $sql = "INSERT INTO Citas (IDUsuario, IDPropiedad, IDAsesor, FechaCita, Estado)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($Con, $sql);
    mysqli_stmt_bind_param($stmt, "iiiss", $idUsuario, $idPropiedad, $idAsesor, $fechaCita, $estado);

    if (mysqli_stmt_execute($stmt)) {
        echo "Cita registrada correctamente.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
desconectar($Con);
?>
