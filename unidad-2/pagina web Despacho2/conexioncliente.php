<?php
$host = 'localhost';
$usuario = 'programador';
$contrasena = '25072003';
$base_de_datos = 'despacho1';


// Establecer conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>