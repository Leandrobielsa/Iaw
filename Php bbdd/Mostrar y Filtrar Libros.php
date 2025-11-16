<?php
// Actividad 4: Obtención de registros de la base de datos

// Incluimos las variables de conexión
include 'cabecera.php';

// Conexión al servidor y selección de la base de datos
$mysqli = new mysqli($servidor, $userBD, $passwdBD, $nomBD);

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Variables
$puntuacion_seleccionada = "";
$query_str = "";

// Comprobamos si se ha enviado una puntuación por POST
if (isset($_POST['puntuacion']) && $_POST['puntuacion'] != "") {
    // Se ha enviado una puntuación
    $puntuacion_seleccionada = (int)$_POST['puntuacion'];
    
    //
    // ADVERTENCIA DE SEGURIDAD:
    // De nuevo, esto es vulnerable a Inyección SQL si no se sanea la entrada.
    // Usar (int) ayuda, pero las consultas preparadas son la mejor práctica.
    //
    $query_str = sprintf("SELECT * FROM libros WHERE puntuacion = %d",
        $puntuacion_seleccionada
    );
    
} else {
    // No se ha enviado puntuación o se ha seleccionado "Todos"
    $query_str = "SELECT * FROM libros";
}

// Realizar la consulta
$resultado = $mysqli->query($query_str);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Libros</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; vertical-align: top; }
        
        /* Estilos para la fila del formulario */
        tr.form-row td { background-color: #f9f9f9; padding: 10px; }
        tr.form-row input[type="text"], tr.form-row select { width: 95%; padding: 5px; border: 1px solid #ccc; border-radius: 4px; }
        tr.form-row input[type="submit"] { background-color: #007bff; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; }
        tr.form-row input[type="submit"]:hover { background-color: #0056b3; }
        
        /* Estilos para la fila de datos */
        tr.data-row:nth-child(even) { background-color: #f2f2f2; }
        tr.data-row:hover { background-color: #eaeaea; }
        
        /* Consulta mostrada */
        .query-display { font-family: monospace; background-color: #eee; padding: 10px; border-radius: 4px; margin: 10px 0; }
    </style>
</head>
<body>

    <h1>Mostrar libres</h1>
    
    <div class="query-display">
        <b>Consulta ejecutada:</b> 
        <?php echo htmlspecialchars($query_str); ?>
    </div>

    <form action="mostrar_libros.php" method="POST">
        <table>
            <!-- Fila del Formulario -->
            <tr class="form-row">
                <td><!-- Columna para ID --></td>
                <td>
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nombre" disabled>
                </td>
                <td>
                    <label for="autor">Autor</label>
                    <input type="text" id="autor" name="autor" disabled>
                </td>
                <td>
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn" disabled>
                </td>
                <td>
                    <label for="puntuacion">Puntuació</label>
                    <select id="puntuacion" name="puntuacion">
                        <option value="" <?php echo ($puntuacion_seleccionada == "") ? "selected" : ""; ?>>Tots</option>
                        <option value="1" <?php echo ($puntuacion_seleccionada == 1) ? "selected" : ""; ?>>1</option>
                        <option value="2" <?php echo ($puntuacion_seleccionada == 2) ? "selected" : ""; ?>>2</option>
                        <option value="3" <?php echo ($puntuacion_seleccionada == 3) ? "selected" : ""; ?>>3</option>
                        <option value="4" <?php echo ($puntuacion_seleccionada == 4) ? "selected" : ""; ?>>4</option>
                        <option value="5" <?php echo ($puntuacion_seleccionada == 5) ? "selected" : ""; ?>>5</option>
                    </select>
                </td>
                <td>
                    <label for="genere">Genere</label>
                    <input type="text" id="genere" name="genero" disabled>
                </td>
                <td>
                    <input type="submit" value="Envia">
                </td>
            </tr>

            <?php
            // Mostrar los libros uno por cada fila de la tabla
            if ($resultado && $resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<tr class="data-row">';
                    echo '<td>' . htmlspecialchars($fila['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($fila['nombre']) . '</td>';
                    echo '<td>' . htmlspecialchars($fila['autor']) . '</td>';
                    echo '<td>' . htmlspecialchars($fila['isbn']) . '</td>';
                    echo '<td>' . htmlspecialchars($fila['puntuacion']) . '</td>';
                    echo '<td>' . htmlspecialchars($fila['genero']) . '</td>';
                    echo '<td></td>'; // Celda vacía para alinear con el botón de envío
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="7">No se encontraron libros con esos criterios.</td></tr>';
            }
            
            // Liberar resultado y cerrar conexión
            $resultado->close();
            $mysqli->close();
            ?>

        </table>
    </form>
    
    <br>
    <a href="FormLibros.html">Añadir nuevo libro</a>

</body>
</html>