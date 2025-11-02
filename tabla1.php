<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 1 - Tabla</title>
    <style>
        table { border-collapse: collapse; margin: 15px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: center; }
        .header-row, .header-col { background-color: #d8bfe8; }
        .cell-yes { background-color: #ffffcc; }
        .cell-no { background-color: #ffebcc; }
        .corner { background-color: #c0d0f0; }
    </style>
</head>
<body>

    <h2>Actividad 1: Tabla de Divisores (1-10)</h2>
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
            // Filas (1 a 10)
            for ($fila = 1; $fila <= 10; $fila++) {
                echo "<tr>";
                // Cabecera de fila
                echo "<th class='header-row'>$fila</th>";
                
                // Celdas de datos
                for ($col = 50; $col <= 60; $col++) {
                    // Comprobamos si es divisible
                    if ($col % $fila == 0) {
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

</body>
</html>