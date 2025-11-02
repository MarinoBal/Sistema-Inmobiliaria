<?php
include('conector.php');
$Con = conectar();

// Obtener amenidades desde la BD
$sql = "SELECT IDAmenidad, Nombre FROM Amenidades ORDER BY Nombre ASC";
$result = mysqli_query($Con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Amenidades a Propiedad</title>
</head>
<body>
    <h2>Asignar Amenidades a una Propiedad</h2>

    <form method="post" action="agregarPropiedadAmenidad.php">
        <label for="idPropiedad">ID de la Propiedad:</label><br>
        <input type="number" name="idPropiedad" id="idPropiedad" required><br><br>

        <label for="idAmenidades">Selecciona Amenidades (click para una, Ctrl + click para varias):</label><br>
        <select name="idAmenidades[]" id="idAmenidades" multiple size="10" required>
            <?php
            // Crear una opción por cada amenidad
            while ($fila = mysqli_fetch_assoc($result)) {
                echo "<option value='{$fila['IDAmenidad']}'>{$fila['Nombre']}</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Guardar Amenidades</button>
    </form>
</body>
</html>

<?php
desconectar($Con);
?>
