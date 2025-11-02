<?php
include('conector.php');
$Con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y sanear datos
    $idUsuario = intval($_POST['idUsuario']);
    $codigoAgente = trim($_POST['codigoAgente']);
    $especialidad = trim($_POST['especialidad']);
    $experiencia = ($_POST['experiencia'] === '') ? null : intval($_POST['experiencia']);
    $zona = trim($_POST['zonaAsignada']);
    $comision = ($_POST['comision'] === '') ? 0.00 : floatval($_POST['comision']);
    $estado = trim($_POST['estado']) ?: 'Activo';
    $fecha = date("Y-m-d");

    // Validaciones básicas
    if (empty($idUsuario) || empty($codigoAgente)) {
        die("Debes seleccionar el usuario y proporcionar un Código de agente.");
    }

    // Verificar que el usuario exista (evitar error FK)
    $check = mysqli_prepare($Con, "SELECT IDUsuario FROM Usuarios WHERE IDUsuario = ?");
    mysqli_stmt_bind_param($check, "i", $idUsuario);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);
    if (mysqli_stmt_num_rows($check) == 0) {
        mysqli_stmt_close($check);
        die("El usuario seleccionado no existe.");
    }
    mysqli_stmt_close($check);

    // Insertar en Agentes (coincide exactamente con la estructura)
    $sql = "INSERT INTO Agentes (IDUsuario, CodigoAgente, Especialidad, Experiencia, ZonaAsignada, Comision, Estado, FechaRegistro)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($Con, $sql);
    // Tipos: i = int, s = string, d = double
    mysqli_stmt_bind_param($stmt, "issisdss", $idUsuario, $codigoAgente, $especialidad, $experiencia, $zona, $comision, $estado, $fecha);

    if (mysqli_stmt_execute($stmt)) {
        echo "Agente agregado correctamente.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
desconectar($Con);
?>
