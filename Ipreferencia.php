<?php
include('conector.php');
$Con = conectar();

$sqlClientes = "SELECT IDUsuario, NombreCompleto FROM Usuarios WHERE Rol = 'Cliente'";
$clientes = mysqli_query($Con, $sqlClientes);

$sqlTipos = "SELECT IDTipo, Nombre FROM TiposPropiedad";
$tipos = mysqli_query($Con, $sqlTipos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Preferencia de Cliente</title>
</head>
<body>
    <h2>Preferencias del Cliente</h2>

    <form method="post" action="agregarPreferencia.php">
        <label>Cliente:</label><br>
        <select name="idUsuario" required>
            <option value="">-- Selecciona Cliente --</option>
            <?php while ($c = mysqli_fetch_assoc($clientes)) { ?>
                <option value="<?= $c['IDUsuario'] ?>"><?= htmlspecialchars($c['NombreCompleto']) ?></option>
            <?php } ?>
        </select><br><br>

        <label>Tipo de Propiedad:</label><br>
        <select name="idTipo">
            <option value="">-- Cualquiera --</option>
            <?php while ($t = mysqli_fetch_assoc($tipos)) { ?>
                <option value="<?= $t['IDTipo'] ?>"><?= htmlspecialchars($t['Nombre']) ?></option>
            <?php } ?>
        </select><br><br>

        <label>Ciudad:</label><br>
        <input type="text" name="ciudad"><br><br>

        <label>Colonia:</label><br>
        <input type="text" name="colonia"><br><br>

        <label>Presupuesto mínimo:</label><br>
        <input type="number" name="presMin" step="0.01"><br><br>

        <label>Presupuesto máximo:</label><br>
        <input type="number" name="presMax" step="0.01"><br><br>

        <label>Mínimo de habitaciones:</label><br>
        <input type="number" name="minHab" min="0"><br><br>

        <label>Mínimo de baños:</label><br>
        <input type="number" name="minBanos" min="0"><br><br>

        <label>Mínimo de estacionamientos:</label><br>
        <input type="number" name="minEst" min="0"><br><br>

        <button type="submit">Guardar Preferencia</button>
    </form>
</body>
</html>

<?php desconectar($Con); ?>
