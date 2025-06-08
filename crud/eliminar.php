<?php
require 'conexion.php';

// Aceptar cédula tanto por GET como por POST
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : (isset($_POST['cedula']) ? $_POST['cedula'] : null);

if ($cedula) {
    // Verificar si el cliente existe
    $sql_check = "SELECT * FROM clientes WHERE cedula = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $cedula);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // Eliminar el cliente
        $sql = "DELETE FROM clientes WHERE cedula = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cedula);

        if ($stmt->execute()) {
            echo "Cliente eliminado correctamente.";
        } else {
            echo "Error al eliminar el cliente.";
        }

        $stmt->close();
    } else {
        echo "Cliente no encontrado.";
    }

    $stmt_check->close();
    $conn->close();
} else {
    echo "No se proporcionó la cédula.";
}
?>
