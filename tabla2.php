<?php
/**
 * Función para recuperar los límites de las filas.
 * Comprueba si 'inicio' y 'fin' vienen por GET.
 * Si no, usa 1 y 10 como valores por defecto.
 */
function recupera() {
    $inicio_defecto = 1;
    $fin_defecto = 10;

    // Comprobar si 'inicio' existe y es un número
    if (isset($_GET['inicio']) && is_numeric($_GET['inicio'])) {
        $fila_i = (int)$_GET['inicio'];
    } else {
        $fila_i = $inicio_defecto;
    }

    // Comprobar si 'fin' existe y es un número
    if (isset($_GET['fin']) && is_numeric($_GET['fin'])) {
        $fila_f = (int)$_GET['fin'];
    } else {
        $fila_f = $fin_defecto;
    }
    
    // Evitar que el fin sea menor que el inicio
    if ($fila_f < $fila_i) {
        $fila_f = $fila_i;
    }

    return [$fila_i, $fila_f];
}

// Llamamos a la función para obtener los valores
list($fila_inicio, $fila_fin) = recupera();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 2 - Tabla Dinámica</title>
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

    <h2>Tabla de Divisores (Filas <?php echo $fila_inicio; ?> a <?php echo $fila_fin; ?>)</h2>
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