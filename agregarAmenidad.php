<?php
include('conector.php');
$Con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);

    if (empty($nombre)) {
        die("Debes ingresar un nombre para la amenidad.");
    }

    // Solo insertamos el campo que realmente existe en la tabla
    $sql = "INSERT INTO Amenidades (Nombre) VALUES (?)";
    $stmt = mysqli_prepare($Con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nombre);

    if (mysqli_stmt_execute($stmt)) {
        echo "Amenidad agregada correctamente.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
desconectar($Con);
?>
