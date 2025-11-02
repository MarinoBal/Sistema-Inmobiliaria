<?php
include('conector.php');
$Con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);

    if (empty($nombre)) {
        die("⚠️ Debes ingresar un nombre para el tipo de propiedad.");
    }

    $sql = "INSERT INTO TiposPropiedad (Nombre) VALUES (?)";
    $stmt = mysqli_prepare($Con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nombre);

    if (mysqli_stmt_execute($stmt)) {
        echo "✅ Tipo de propiedad agregado correctamente.";
    } else {
        echo "❌ Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
desconectar($Con);
?>
