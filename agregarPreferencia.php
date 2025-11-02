<?php
include('conector.php');
$Con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = intval($_POST['idUsuario']);
    $idTipo = ($_POST['idTipo'] == "") ? NULL : intval($_POST['idTipo']);
    $ciudad = trim($_POST['ciudad']);
    $colonia = trim($_POST['colonia']);
    $presMin = ($_POST['presMin'] == "") ? NULL : floatval($_POST['presMin']);
    $presMax = ($_POST['presMax'] == "") ? NULL : floatval($_POST['presMax']);
    $minHab = ($_POST['minHab'] == "") ? NULL : intval($_POST['minHab']);
    $minBanos = ($_POST['minBanos'] == "") ? NULL : intval($_POST['minBanos']);
    $minEst = ($_POST['minEst'] == "") ? NULL : intval($_POST['minEst']);
    $fecha = date("Y-m-d");

    if (empty($idUsuario)) {
        die("⚠️ Debes seleccionar un cliente.");
    }

    // INSERT correcto (10 columnas)
    $sql = "INSERT INTO PreferenciasCliente 
            (IDUsuario, IDTipo, Ciudad, Colonia, PresupuestoMin, PresupuestoMax, MinHabitaciones, MinBanos, MinEstacionamientos, FechaActualizacion)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($Con, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "iissddiiis",$idUsuario,$idTipo,$ciudad,$colonia,$presMin,$presMax,$minHab,$minBanos,$minEst,$fecha
    );


    if (mysqli_stmt_execute($stmt)) {
        echo "✅ Preferencia registrada correctamente.";
    } else {
        echo "❌ Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
desconectar($Con);
?>
