<?php
include 'conexion.php';

// Consulta SQL para obtener todos los clientes
$sql = "SELECT * FROM clientes";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link rel="icon" type="img/png" href="../img/favicon.png" />
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <div class="contenedor-principal">
        <header>
            <div class="logo">
                <div class="logoAncho">
                    <img src="../img/logo.png" alt="Logo de EscobARQ" class="logoDimension" />
                </div>
                <div class="bannerAncho">
                    <h1 style="margin: 0;">EscobARQ Soluciones Integrales</h1>
                    <nav>
                        <ul style="margin: 0; padding: 0; list-style: none;">
                            <li style="display: inline; margin-right: 15px;"><a href="../index.html">Inicio</a></li>
                            <li style="display: inline; margin-right: 15px;"><a href="../admin.html">Registro de Clientes</a></li>
                            <li style="display: inline; margin-right: 15px;"><a href="../gestor.html">Cerrar Sesión</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <div class="admin-table">
            <h2>Listado de Clientes Registrados</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Cédula</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Sexo</th>
                        <th>Fecha Nacimiento</th>
                        <th>Tipo de Cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $fila["nombres"] . "</td>";
                            echo "<td>" . $fila["apellidos"] . "</td>";
                            echo "<td>" . $fila["cedula"] . "</td>";
                            echo "<td>" . $fila["correo"] . "</td>";
                            echo "<td>" . $fila["telefono"] . "</td>";
                            echo "<td>" . $fila["direccion"] . "</td>";
                            echo "<td>" . $fila["genero"] . "</td>";
                            echo "<td>" . $fila["fecha_nacimiento"] . "</td>";
                            echo "<td>" . $fila["tipo"] . "</td>";
                            echo "<td class='acciones'>
                        <a href='editar.php?cedula=" . $fila["cedula"] . "' class='editar'>Editar</a>
                        <button class='eliminar' data-cedula='" . $fila["cedula"] . "'>Eliminar</button>
                        </td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No hay clientes registrados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="mensaje" style="display:none; margin: 10px; padding: 10px; border-radius: 5px;"></div>
    </div>
    <footer>
        <p>Contacto: samitolrmc@gmail.com | WhatsApp:3122328116| Villavicencio - Meta</p>
        <p>&copy; 2025 EscobARQ | Todos los derechos reservados</p>
    </footer>
</body>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mensaje = document.getElementById("mensaje");

        document.querySelectorAll(".eliminar").forEach(boton => {
            boton.addEventListener("click", () => {
                const cedula = boton.getAttribute("data-cedula");

                if (!confirm("¿Seguro que deseas eliminar este cliente?")) return;

                fetch("eliminar.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "cedula=" + encodeURIComponent(cedula)
                    })
                    .then(res => res.text())
                    .then(respuesta => {
                        mensaje.innerText = respuesta;
                        mensaje.style.display = "block";

                        if (respuesta.toLowerCase().includes("eliminado")) {
                            mensaje.style.backgroundColor = "green";
                            // Eliminar fila del DOM
                            boton.closest("tr").remove();
                        } else {
                            mensaje.style.backgroundColor = "red";
                        }

                        setTimeout(() => mensaje.style.display = "none", 8000);
                    })
                    .catch(() => {
                        mensaje.innerText = "Ocurrió un error al eliminar el cliente.";
                        mensaje.style.display = "block";
                        mensaje.style.backgroundColor = "red";
                        setTimeout(() => mensaje.style.display = "none", 8000);
                    });
            });
        });
    });
</script>


</html>

<?php
$conn->close();
?>