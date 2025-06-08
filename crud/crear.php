<?php
// Importar archivo de conexión
require_once "conexion.php";

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar y limpiar datos del formulario
    $cedula = $conn->real_escape_string($_POST["cedula"]);
    $nombres = $conn->real_escape_string($_POST["nombres"]);
    $apellidos = $conn->real_escape_string($_POST["apellidos"]);
    $genero = $conn->real_escape_string($_POST["genero"]);
    $fecha_nacimiento = $conn->real_escape_string($_POST["fecha_nacimiento"]);
    $direccion = $conn->real_escape_string($_POST["direccion"]);
    $telefono = $conn->real_escape_string($_POST["telefono"]);
    $correo = $conn->real_escape_string($_POST["correo"]);
    $tipo = $conn->real_escape_string($_POST["tipo"]);

    // Consulta SQL para insertar datos
    $sql = "INSERT INTO clientes (cedula, nombres, apellidos, genero, fecha_nacimiento, direccion, telefono, correo, tipo)
            VALUES ('$cedula', '$nombres', '$apellidos', '$genero', '$fecha_nacimiento', '$direccion', '$telefono', '$correo', '$tipo')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Cliente registrado exitosamente.";
    } else {
        echo "Error: " . $conn->error;
    }

    /* Verificar si ya existe un cliente con esa cédula
    $sql_check = "SELECT * FROM clientes WHERE cedula = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $cedula);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo " >>> Ya existe un cliente con esta cédula.";
        exit();
    }
    */

    // Cerrar conexión
    $conn->close();
} else {
    echo "Acceso no autorizado.";
}
