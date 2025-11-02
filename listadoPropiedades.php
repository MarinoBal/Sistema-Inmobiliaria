<?php
include('conector.php');
$Con = conectar();

// Consulta que trae propiedades con su tipo
$sql = "SELECT 
            P.Titulo,
            P.Descripcion,
            P.Precio,
            P.Ciudad,
            T.Nombre AS TipoPropiedad
        FROM Propiedades P
        LEFT JOIN TiposPropiedad T ON P.IDTipo = T.IDTipo
        ORDER BY P.FechaPublicacion DESC";

$result = mysqli_query($Con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Propiedades disponibles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        .contenedor {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .tarjeta {
            background: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            width: 280px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        }
        .tarjeta h3 {
            color: #2c3e50;
            margin: 0 0 10px 0;
        }
        .precio {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>🏘️ Propiedades disponibles</h2>

    <div class="contenedor">
        <?php while ($prop = mysqli_fetch_assoc($result)) { ?>
            <div class="tarjeta">
                <h3><?= htmlspecialchars($prop['Titulo']) ?></h3>
                <p><b>Tipo:</b> <?= htmlspecialchars($prop['TipoPropiedad'] ?? 'Sin especificar') ?></p>
                <p><b>Ciudad:</b> <?= htmlspecialchars($prop['Ciudad']) ?></p>
                <p><b>Descripción:</b><br><?= htmlspecialchars($prop['Descripcion']) ?></p>
                <p class="precio">💲<?= number_format($prop['Precio'], 2) ?></p>
                <button>Ver detalles</button>
            </div>
        <?php } ?>
    </div>
</body>
</html>

<?php desconectar($Con); ?>
