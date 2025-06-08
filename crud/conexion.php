<?php
// Datos de conexión
$host = "localhost";
$usuario = "root";
$contrasena = "12345678"; 
$base_datos = "escobarq_db"; // Base de datos a la cual conectarse

// Crear la conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Opcional: definir el juego de caracteres para evitar errores con tildes y ñ
$conn->set_charset("utf8");

?>
