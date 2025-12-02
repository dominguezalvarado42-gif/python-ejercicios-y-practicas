<?php
// Incluir el archivo de conexión
require_once "conexioncliente.php";

// Verificar si se han enviado datos por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['Nombres'];
    $apellidos = $_POST['Apellidos'];
    $gmail = $_POST['email'];
    $telefono = $_POST['phone'];

    // Preparar la consulta SQL con parámetros
    $sql = "INSERT INTO usuarios (Nombre, Apellidos, Gmail, Teléfono) VALUES (?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros con los valores del formulario
        $stmt->bind_param("ssss", $nombre, $apellidos, $gmail, $telefono);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro exitoso";

            // Redirigir a index.html después del registro exitoso
            header('Location: index.html');
            exit; // Terminar la ejecución del script después de la redirección
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
}

// Cerrar conexión al finalizar (opcional)
$conexion->close();
?>
