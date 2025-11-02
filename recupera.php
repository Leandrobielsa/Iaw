<?php
/**
 * Archivo 'recupera.php'
 * Contiene únicamente la función para recuperar los límites de las filas.
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
?>