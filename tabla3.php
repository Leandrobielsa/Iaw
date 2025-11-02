<?php
// 1. Incluimos el archivo con la función
include 'recupera.php';

// 2. Llamamos a la función (que ya está cargada)
list($fila_inicio, $fila_fin) = recupera();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 3 - Tabla con Include</title>
    <style>
        table { border-collapse: collapse; margin: 15px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: center; }
        .header-row, .header-col { background-color: #d8bfe8; }
        .cell-yes { background-color: #ffffcc; }
        .cell-no { background-color: #ffebcc; }
        .corner { background-color: #c0d0f0; }
        a { display:inline-block; margin-top: 15px; margin-left: 15px; }
    </style>
</head>
<body>

    <h2>Actividad 3: Tabla (Filas <?php echo $fila_inicio; ?> a <?php echo $fila_fin; ?>)</h2>
    <table>
        <thead>
            <tr>
                <th class="corner">&nbsp;</th>
                <?php
                // Cabeceras de columna (50 a 60)
                for ($col = 50; $col <= 60; $col++) {
                    echo "<th class='header-col'>$col</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Filas (dinámicas, según los valores de la función)
            for ($fila = $fila_inicio; $fila <= $fila_fin; $fila++) {
                echo "<tr>";
                // Cabecera de fila
                echo "<th class='header-row'>$fila</th>";
                
                // Celdas de datos
                for ($col = 50; $col <= 60; $col++) {
                    // Comprobamos si es divisible (y evitamos error de división por cero)
                    if ($fila != 0 && $col % $fila == 0) {
                        echo "<td class='cell-yes'>*</td>";
                    } else {
                        echo "<td class='cell-no'>-</td>";
                    }
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    
    <a href="tabla_1.html">Volver al formulario</a>

</body>
</html>