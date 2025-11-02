<?php
include('conector.php');
$Con = conectar(); 

if (!$Con) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    // esto es para cifrar la contrasena antes de guardarla
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    
    $rol = $_POST['rol'];
    $fecha = date("Y-m-d");

    // esto es un cambio importante para evitar inyecciones SQL
    //se crea una plantilla SQL con "?" en lugar de los valores directos
    $sql_plantilla = "INSERT INTO Usuarios (NombreCompleto, Correo, Telefono, Contrasena, Rol, FechaRegistro)
                      VALUES (?, ?, ?, ?, ?, ?)";
    
    //Esto le dice a la BD que revise la plantilla.
    $stmt = mysqli_prepare($Con, $sql_plantilla);

    if ($stmt === false) {
        // Si la plantilla SQL tiene un error de sintaxis, fallará aquí
        echo "❌ Error al preparar la consulta: " . mysqli_error($Con);
    } else {

        //se ponen los valores en la plantilla dentro de los "?", cada ? es un parametro
        // "ssssss" indica que todos los parametros son strings
        //si hubiera un entero se pondria una "i" en lugar de una "s"
        //al asi: "issssss"
        mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $correo, $telefono, $contrasena, $rol, $fecha);

        // Ejecutar la consulta preparada
        if (mysqli_stmt_execute($stmt)) {
            echo "✅ Usuario agregado correctamente";
        } else {
            echo "❌ Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
        }
        // Cerrar la declaracion preparada
        mysqli_stmt_close($stmt);
    }
}

desconectar($Con);
?>