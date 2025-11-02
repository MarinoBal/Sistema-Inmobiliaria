<?php
include('conector.php');
$Con = conectar();

// Obtener clientes
$sqlClientes = "SELECT IDUsuario, NombreCompleto FROM Usuarios WHERE Rol = 'Cliente'";
$clientes = mysqli_query($Con, $sqlClientes);

// Obtener asesores
$sqlAsesores = "SELECT IDUsuario, NombreCompleto FROM Usuarios WHERE Rol = 'Asesor'";
$asesores = mysqli_query($Con, $sqlAsesores);

// Obtener propiedades
$sqlPropiedades = "SELECT IDPropiedad, Titulo FROM Propiedades";
$propiedades = mysqli_query($Con, $sqlPropiedades);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cita</title>
</head>
<body>
    <h2>Agendar Cita</h2>

    <form method="post" action="agregarCita.php">
        <label for="idUsuario">Cliente:</label><br>
        <select name="idUsuario" id="idUsuario" required>
            <option value="">-- Selecciona Cliente --</option>
            <?php while ($fila = mysqli_fetch_assoc($clientes)) { ?>
                <option value="<?= $fila['IDUsuario'] ?>"><?= $fila['NombreCompleto'] ?></option>
            <?php } ?>
        </select><br><br>

        <label for="idAsesor">Asesor:</label><br>
        <select name="idAsesor" id="idAsesor" required>
            <option value="">-- Selecciona Asesor --</option>
            <?php while ($fila = mysqli_fetch_assoc($asesores)) { ?>
                <option value="<?= $fila['IDUsuario'] ?>"><?= $fila['NombreCompleto'] ?></option>
            <?php } ?>
        </select><br><br>

        <label for="idPropiedad">Propiedad:</label><br>
        <select name="idPropiedad" id="idPropiedad" required>
            <option value="">-- Selecciona Propiedad --</option>
            <?php while ($fila = mysqli_fetch_assoc($propiedades)) { ?>
                <option value="<?= $fila['IDPropiedad'] ?>"><?= $fila['Titulo'] ?></option>
            <?php } ?>
        </select><br><br>

        <label for="fechaCita">Fecha y hora de la cita:</label><br>
        <input type="date" name="fechaCita" id="fechaCita" required>
        <br><br>

        <label for="estado">Estado:</label><br>
        <select name="estado" id="estado" required>
            <option value="Pendiente">Pendiente</option>
            <option value="Confirmada">Confirmada</option>
            <option value="Cancelada">Cancelada</option>
            <option value="Completada">Completada</option>
        </select><br><br>

        <button type="submit">Guardar Cita</button>
    </form>
</body>
</html>

<?php
desconectar($Con);
?>
