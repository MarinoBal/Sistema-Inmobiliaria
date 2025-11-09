<?php
include("conector.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $idusuario = $_POST["idusuario"];
    $idtipo = $_POST["idtipo"];
    $ciudad = $_POST["ciudad"];
    $colonia = $_POST["colonia"];
    $presupuestoMin = $_POST["presupuestoMin"];
    $presupuestoMax = $_POST["presupuestoMax"];
    $minHabitaciones = $_POST["minHabitaciones"];
    $minBanos = $_POST["minBanos"];
    $minEstacionamientos = $_POST["minEstacionamientos"];
    $fecha = $_POST["fecha"];

    if (empty($idusuario) || empty($fecha)) {
        echo "❌ Faltan datos obligatorios.";
        exit;
    }

    $sql = "UPDATE PreferenciasCliente SET 
                IDUsuario=$idusuario,
                IDTipo=" . ($idtipo ? $idtipo : "NULL") . ",
                Ciudad='$ciudad',
                Colonia='$colonia',
                PresupuestoMin=" . ($presupuestoMin !== "" ? $presupuestoMin : "NULL") . ",
                PresupuestoMax=" . ($presupuestoMax !== "" ? $presupuestoMax : "NULL") . ",
                MinHabitaciones=" . ($minHabitaciones !== "" ? $minHabitaciones : "NULL") . ",
                MinBanos=" . ($minBanos !== "" ? $minBanos : "NULL") . ",
                MinEstacionamientos=" . ($minEstacionamientos !== "" ? $minEstacionamientos : "NULL") . ",
                FechaActualizacion='$fecha'
            WHERE IDPreferencia=$id";

    if (mysqli_query($conexion, $sql)) {
        echo "✅ Preferencia actualizada correctamente.";
    } else {
        echo "❌ Error al actualizar: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
