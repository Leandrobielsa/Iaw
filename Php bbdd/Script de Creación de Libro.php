<?php
// Actividad 3: Creación de registros (libros)

// Incluimos las variables de conexión
include 'cabecera.php';

// Comprobamos si se han enviado datos por POST
if (!isset($_POST['isbn'])) {
    die("No se han recibido datos del formulario. <a href='FormLibros.html'>Volver</a>");
}

// --- Técnica de depuración: Mostrar datos recibidos ---
echo "<h2>Datos recibidos (para depuración):</h2>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo "<hr>";
// --- Fin de la técnica de depuración ---


// Conexión al servidor y selección de la base de datos
$mysqli = new mysqli($servidor, $userBD, $passwdBD, $nomBD);

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Recogemos los datos del formulario
$nombre = $_POST['nombre'];
$autor = $_POST['autor'];
$isbn = $_POST['isbn'];
$puntuacion = (int)$_POST['puntuacion']; // Aseguramos que sea un entero
$genero = $_POST['genero'];

//
// ADVERTENCIA DE SEGURIDAD:
// Al igual que en ComprobarLogin.php, usar sprintf es vulnerable a Inyección SQL.
// Se deberían usar consultas preparadas (prepared statements).
//

// 1. Comprobar si ya existe un libro con el mismo ISBN
$query_check = sprintf("SELECT * FROM libros WHERE isbn='%s'",
    $mysqli->real_escape_string($isbn)
);

echo "<p><b>Consulta de comprobación (depuración):</b> <code>" . htmlspecialchars($query_check) . "</code></p>";

$resultado_check = $mysqli->query($query_check);

if ($resultado_check && $resultado_check->num_rows > 0) {
    // Si num_rows > 0, el libro ya existe
    echo "<h1>Error al crear el libro</h1>";
    echo "<p>Ya existe un libro con el ISBN: " . htmlspecialchars($isbn) . "</p>";
    $resultado_check->close();
} else {
    // 2. Si no existe, lo creamos
    $query_insert = sprintf("INSERT INTO libros (nombre, autor, isbn, puntuacion, genero) VALUES ('%s', '%s', '%s', %d, '%s')",
        $mysqli->real_escape_string($nombre),
        $mysqli->real_escape_string($autor),
        $mysqli->real_escape_string($isbn),
        $puntuacion,
        $mysqli->real_escape_string($genero)
    );

    echo "<p><b>Consulta de inserción (depuración):</b> <code>" . htmlspecialchars($query_insert) . "</code></p>";

    if ($mysqli->query($query_insert) === TRUE) {
        echo "<h1>¡Libro creado con éxito!</h1>";
        echo "<p>El libro '" . htmlspecialchars($nombre) . "' ha sido añadido a la base de datos.</p>";
    } else {
        echo "<h1>Error al insertar</h1>";
        echo "<p>Error: " . $mysqli->error . "</p>";
    }
}

// Cerramos la conexión
$mysqli->close();

echo '<br><a href="FormLibros.html">Añadir otro libro</a>';
echo '<br><a href="mostrar_libros.php">Ver todos los libros</a>';
?>