<?php
// Datos de conexión a la base de datos
$host = 'localhost'; // Cambia esto por la dirección del servidor de la base de datos si es necesario
$usuario_bd = 'tu_usuario_bd'; // Cambia esto por tu nombre de usuario de la base de datos
$contrasena_bd = 'tu_contrasena_bd'; // Cambia esto por tu contraseña de la base de datos
$nombre_bd = 'despacho1'; // Cambia esto por el nombre de tu base de datos

// Establecer conexión con la base de datos
$conexion = new mysqli($host, $usuario_bd, $contrasena_bd, $nombre_bd);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Obtener datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE Nombre_Usuario = '$usuario' AND Contraseña = '$contrasena'";
    $resultado = $conexion->query($sql);

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if ($resultado->num_rows > 0) {
        // Inicio de sesión exitoso, redirigir al usuario a index.html
        header("Location: index.html");
        exit();
    } else {
        // Credenciales incorrectas, redirigir de nuevo a crud.html con un mensaje de error
        header("Location: crud.html?error=credenciales");
        exit();
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>