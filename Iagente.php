<?php
include('conector.php');
$Con = conectar();

// Traer usuarios (puedes filtrar por Rol = 'Asesor' si así lo deseas)
$sqlUsuarios = "SELECT IDUsuario, NombreCompleto, Correo, Rol FROM Usuarios ORDER BY NombreCompleto";
$usuarios = mysqli_query($Con, $sqlUsuarios);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Registrar Agente</title></head>
<body>
    <h2>Registro de Agente</h2>
    <form method="post" action="agregarAgente.php">
        <label for="idUsuario">Usuario (vinculado):</label><br>
        <select name="idUsuario" id="idUsuario" required>
            <option value="">-- Selecciona Usuario --</option>
            <?php while ($u = mysqli_fetch_assoc($usuarios)) { ?>
                <option value="<?= $u['IDUsuario'] ?>">
                    <?= htmlspecialchars($u['NombreCompleto'] . ' (' . $u['Rol'] . ') - ' . $u['Correo']) ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label for="codigoAgente">Código de Agente:</label><br>
        <input type="text" name="codigoAgente" id="codigoAgente" required><br><br>

        <label for="especialidad">Especialidad:</label><br>
        <input type="text" name="especialidad" id="especialidad"><br><br>

        <label for="experiencia">Años de experiencia:</label><br>
        <input type="number" name="experiencia" id="experiencia" min="0"><br><br>

        <label for="zonaAsignada">Zona asignada:</label><br>
        <input type="text" name="zonaAsignada" id="zonaAsignada"><br><br>

        <label for="comision">Comisión (%) :</label><br>
        <input type="number" step="0.01" name="comision" id="comision" min="0" max="100"><br><br>

        <label for="estado">Estado:</label><br>
        <select name="estado" id="estado" required>
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
        </select><br><br>

        <button type="submit">Guardar Agente</button>
    </form>
</body>
</html>
<?php desconectar($Con); ?>
