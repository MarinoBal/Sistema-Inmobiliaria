<?php
include('conector.php');
$Con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $colonia = $_POST['colonia'];
    $superficie = $_POST['superficie'];
    $terreno = $_POST['terreno'];
    $habitaciones = $_POST['habitaciones'];
    $banos = $_POST['banos'];
    $estacionamientos = $_POST['estacionamientos'];
    $estado = $_POST['estado'];
    $fecha = date("Y-m-d");
    $idTipo = $_POST['idTipo'];
    $idAsesor = $_POST['idAsesor'];

    $sql = "INSERT INTO Propiedades (Titulo, Descripcion, Precio, Direccion, Ciudad, Colonia, Superficie, Terreno, Habitaciones, Banos, Estacionamientos, Estado, FechaPublicacion, IDTipo, IDAsesor)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($Con, $sql);
    mysqli_stmt_bind_param($stmt, "ssisssddiiissii",
        $titulo, $descripcion, $precio, $direccion, $ciudad, $colonia,
        $superficie, $terreno, $habitaciones, $banos, $estacionamientos,
        $estado, $fecha, $idTipo, $idAsesor
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Propiedad agregada correctamente";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
desconectar($Con);
?>
