<?php
// Importar archivo de conexión
require_once "conexion.php";

// Verificar si el formulario fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar y limpiar datos
    $cedula = $conn->real_escape_string($_POST["cedula"]);
    $nombres = $conn->real_escape_string($_POST["nombres"]);
    $apellidos = $conn->real_escape_string($_POST["apellidos"]);
    $genero = $conn->real_escape_string($_POST["genero"]);
    $fecha_nacimiento = $conn->real_escape_string($_POST["fecha_nacimiento"]);
    $direccion = $conn->real_escape_string($_POST["direccion"]);
    $telefono = $conn->real_escape_string($_POST["telefono"]);
    $correo = $conn->real_escape_string($_POST["correo"]);
    $tipo = $conn->real_escape_string($_POST["tipo"]);

    // Verificar si el cliente existe
    $verificar = "SELECT * FROM clientes WHERE cedula = '$cedula'";
    $resultado = $conn->query($verificar);

    if ($resultado->num_rows > 0) {
        // Actualizar datos
        $sql = "UPDATE clientes SET 
                    nombres = '$nombres',
                    apellidos = '$apellidos',
                    genero = '$genero',
                    fecha_nacimiento = '$fecha_nacimiento',
                    direccion = '$direccion',
                    telefono = '$telefono',
                    correo = '$correo',
                    tipo = '$tipo'
                WHERE cedula = '$cedula'";

        if ($conn->query($sql) === TRUE) {
            echo "Cliente actualizado exitosamente.";
        } else {
            echo "Error al actualizar cliente: " . $conn->error;
        }
    } else {
        echo "No se encontró ningún cliente con esa cédula.";
    }

    // Cerrar conexión
    $conn->close();
} else {
    echo "Acceso no autorizado.";
}
