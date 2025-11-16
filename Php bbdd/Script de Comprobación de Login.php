<?php
// Actividad 2: Comprobación de login

// Incluimos las variables de conexión
include 'cabecera.php';

// Conexión al servidor y selección de la base de datos
$mysqli = new mysqli($servidor, $userBD, $passwdBD, $nomBD);

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Recogemos los datos del formulario
$usuario = $_POST['usuario'];
$clave_form = $_POST['clave'];

// Encriptamos la contraseña recibida con MD5 para compararla con la de la BD
$clave_md5 = md5($clave_form);

//
// ADVERTENCIA DE SEGURIDAD:
// El uso de sprintf y md5 es un requisito de la actividad, pero no es seguro.
// md5 es un algoritmo obsoleto y este método es vulnerable a Inyección SQL.
// En una aplicación real, se deberían usar funciones de hash seguras (como password_hash)
// y consultas preparadas (prepared statements) para prevenir ataques.
//

// Creamos la consulta con sprintf
$query_str = sprintf("SELECT * FROM usuarios WHERE nombre='%s' AND clave='%s'",
    $mysqli->real_escape_string($usuario), // Escapamos la variable para prevenir inyección SQL simple
    $mysqli->real_escape_string($clave_md5)  // Escapamos la variable
);

echo "<h3>Consulta generada (para depuración):</h3>";
echo "<p><code>" . htmlspecialchars($query_str) . "</code></p>";

// Lanzamos la consulta
$resultado = $mysqli->query($query_str);

// Comprobamos si hay un usuario con ese nombre y contraseña
if ($resultado && $resultado->num_rows > 0) {
    echo "<h1>¡Login correcto!</h1>";
    echo "<p>Bienvenido, " . htmlspecialchars($usuario) . ".</p>";
    // Aquí normalmente se iniciaría una sesión
    // session_start();
    // $_SESSION['usuario'] = $usuario;
} else {
    echo "<h1>Error</h1>";
    echo "<p>Nombre de usuario o contraseña incorrectos.</p>";
    echo '<a href="login.html">Volver a intentar</a>';
}

// Cerramos la conexión
$resultado->close();
$mysqli->close();
?>