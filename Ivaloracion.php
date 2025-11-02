<?php
include('conector.php');
$Con = conectar();

// Obtener clientes (solo los de rol Cliente)
$sqlUsuarios = "SELECT IDUsuario, NombreCompleto FROM Usuarios WHERE Rol = 'Cliente'";
$usuarios = mysqli_query($Con, $sqlUsuarios);

// Obtener agentes
$sqlAgentes = "SELECT IDAgente, CodigoAgente, ZonaAsignada FROM Agentes";
$agentes = mysqli_query($Con, $sqlAgentes);

// Obtener propiedades
$sqlPropiedades = "SELECT IDPropiedad, Titulo FROM Propiedades";
$propiedades = mysqli_query($Con, $sqlPropiedades);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Valoración</title>
</head>
<body>
    <h2>Registrar Valoración</h2>

    <form method="post" action="agregarValoracion.php">

        <label for="idUsuario">Cliente:</label><br>
        <select name="idUsuario" id="idUsuario" required>
            <option value="">-- Selecciona Cliente --</option>
            <?php while ($fila = mysqli_fetch_assoc($usuarios)) { ?>
                <option value="<?= $fila['IDUsuario'] ?>">
                    <?= htmlspecialchars($fila['NombreCompleto']) ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label for="idAgente">Agente (opcional):</label><br>
        <select name="idAgente" id="idAgente">
            <option value="">-- Ninguno --</option>
            <?php while ($fila = mysqli_fetch_assoc($agentes)) { ?>
                <option value="<?= $fila['IDAgente'] ?>">
                    <?= htmlspecialchars($fila['CodigoAgente'] . " - " . $fila['ZonaAsignada']) ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label for="idPropiedad">Propiedad:</label><br>
        <select name="idPropiedad" id="idPropiedad" required>
            <option value="">-- Selecciona Propiedad --</option>
            <?php while ($fila = mysqli_fetch_assoc($propiedades)) { ?>
                <option value="<?= $fila['IDPropiedad'] ?>">
                    <?= htmlspecialchars($fila['Titulo']) ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label for="puntuacion">Puntuacion (1 a 5):</label><br>
        <input type="number" name="puntuacion" id="puntuacion" min="1" max="5" required><br><br>

        <label for="comentario">Comentario:</label><br>
        <textarea name="comentario" id="comentario" rows="4" cols="40" placeholder="Escribe tu opinión..."></textarea><br><br>

        <button type="submit">Guardar Valoración</button>
    </form>
</body>
</html>

<?php
desconectar($Con);
?>
