<?php
include('conector.php');
$Con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPropiedad = $_POST['idPropiedad'];
    $amenidades = $_POST['idAmenidades']; // array de IDs seleccionados

    if (empty($idPropiedad) || empty($amenidades)) {
        die("⚠️ Debes seleccionar una propiedad y al menos una amenidad.");
    }

    // Consulta preparada
    $sql = "INSERT INTO PropiedadAmenidad (IDPropiedad, IDAmenidad) VALUES (?, ?)";
    $stmt = mysqli_prepare($Con, $sql);

    $insertadas = 0;
    foreach ($amenidades as $idAmenidad) {
        // Convertir a número por seguridad
        $idAmenidad = intval($idAmenidad);

        // Intentar ejecutar cada inserción
        if (mysqli_stmt_bind_param($stmt, "ii", $idPropiedad, $idAmenidad) &&
            mysqli_stmt_execute($stmt)) {
            $insertadas++;
        } else {
            // Si la combinación ya existe, ignoramos el error (clave única)
            if (mysqli_errno($Con) == 1062) continue;
        }
    }

    mysqli_stmt_close($stmt);
    desconectar($Con);

    echo "✅ Se asignaron $insertadas amenidad(es) correctamente a la propiedad.";
}
?>
