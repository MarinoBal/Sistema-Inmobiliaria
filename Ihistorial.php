<?php
include('conector.php');
$Con = conectar();

// Obtener usuarios registrados
$sqlUsuarios = "SELECT IDUsuario, NombreCompleto FROM Usuarios";
$usuarios = mysqli_query($Con, $sqlUsuarios);

// Obtener propiedades
$sqlPropiedades = "SELECT IDPropiedad, Titulo FROM Propiedades";
$propiedades = mysqli_query($Con, $sqlPropiedades);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Historial</title>
</head>
<body>
    <h2>Registro de Historial de Visualización</h2>

    <form method="post" action="agregarHistorial.php">
        <label>Usuario:</label><br>
        <select name="idUsuario" required>
            <option value="">-- Selecciona Usuario --</option>
            <?php while ($u = mysqli_fetch_assoc($usuarios)) { ?>
                <option value="<?= $u['IDUsuario'] ?>"><?= htmlspecialchars($u['NombreCompleto']) ?></option>
            <?php } ?>
        </select><br><br>

        <label>Propiedad:</label><br>
        <select name="idPropiedad" required>
            <option value="">-- Selecciona Propiedad --</option>
            <?php while ($p = mysqli_fetch_assoc($propiedades)) { ?>
                <option value="<?= $p['IDPropiedad'] ?>"><?= htmlspecialchars($p['Titulo']) ?></option>
            <?php } ?>
        </select><br><br>

        <label>Duración en segundos (opcional):</label><br>
        <input type="number" name="duracion" min="0" placeholder="Ejemplo: 120"><br><br>

        <button type="submit">Guardar Historial</button>
    </form>
</body>
</html>

<?php desconectar($Con); ?>
