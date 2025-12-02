<?php
// Incluir archivo de conexión
require_once 'conexioncliente.php';

// Verificar si se han enviado datos del formulario mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario y limpiarlos usando mysqli_real_escape_string para mayor seguridad
    $username = $conexion->real_escape_string($_POST['username']);
    $password = $conexion->real_escape_string($_POST['password']);

    // Consulta para verificar las credenciales en la base de datos
    $sql = "SELECT * FROM usuarios WHERE Nombre_Usuario = '$username' AND Contraseña = '$password'";
    $resultado = $conexion->query($sql);

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if ($resultado && $resultado->num_rows > 0) {
        // Credenciales válidas - Inicio de sesión exitoso
        // Redirigir al usuario a index.html después de iniciar sesión
        header("Location: index.html");
        exit; // Asegurar que el script se detenga después de la redirección
    } else {
        // Credenciales inválidas - Redirigir de vuelta a login.html con mensaje de error
        header("Location: login.html?error=incorrecto");
        exit; // Asegurar que el script se detenga después de la redirección
    }
}

// Cerrar conexión a la base de datos al finalizar el script
$conexion->close();
?>