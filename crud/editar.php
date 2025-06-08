<?php
include 'conexion.php';

if (isset($_GET['cedula'])) {
  $cedula = $_GET['cedula'];

  // Obtener datos del cliente
  $sql = "SELECT * FROM clientes WHERE cedula='$cedula'";
  $resultado = $conn->query($sql);

  if ($resultado->num_rows > 0) {
    $cliente = $resultado->fetch_assoc();
  } else {
    echo "Cliente no encontrado.";
    exit();
  }
} else {
  echo "No se proporcionó la cédula.";
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
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
              <li style="display: inline; margin-right: 15px;"><a href="./leer.php">Listado de Clientes</a></li>
              <li style="display: inline; margin-right: 15px;"><a href="../gestor.html">Cerrar Sesión</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </header>

    <div class="admin-panel">
      <h2>Editar Cliente </h2>
      <form id="clienteFormUpdate">
        <div class="form-columns">
          <div class="column">
            <input type="hidden" name="cedula" value="<?php echo $cliente['cedula']; ?>">

            <label>Nombres:</label>
            <input type="text" name="nombres" value="<?php echo $cliente['nombres']; ?>" required>

            <label>Apellidos:</label>
            <input type="text" name="apellidos" value="<?php echo $cliente['apellidos']; ?>" required>

            <label>Correo electrónico:</label>
            <input type="email" name="correo" value="<?php echo $cliente['correo']; ?>">

            <label>Teléfono celular:</label>
            <input type="text" name="telefono" value="<?php echo $cliente['telefono']; ?>">
          </div>

          <div class="column">
            <label>Dirección:</label>
            <input type="text" name="direccion" value="<?php echo $cliente['direccion']; ?>">

            <label>Sexo:</label>
            <select name="genero">
              <option value="Masculino" <?php if ($cliente['genero'] == 'Masculino') echo 'selected'; ?>>Masculino</option>
              <option value="Femenino" <?php if ($cliente['genero'] == 'Femenino') echo 'selected'; ?>>Femenino</option>
            </select>

            <label>Fecha de nacimiento:</label>
            <input type="date" name="fecha_nacimiento" class="input-fecha" value="<?php echo $cliente['fecha_nacimiento']; ?>">

            <label>Tipo:</label>
            <select name="tipo">
              <option value="Nuevo" <?php if ($cliente['tipo'] == 'Nuevo') echo 'selected'; ?>>Nuevo</option>
              <option value="Casual" <?php if ($cliente['tipo'] == 'Casual') echo 'selected'; ?>>Casual</option>
              <option value="Permanente" <?php if ($cliente['tipo'] == 'Permanente') echo 'selected'; ?>>Permanente</option>
            </select>
          </div>
        </div>
        <button type="submit">Actualizar</button>
        <div id="mensaje"
          style="display:none; margin-top: 10px; color: white; background-color: green; padding: 10px; border-radius: 5px;">
        </div>
      </form>
    </div>
    <footer>
      <p>Contacto: samitolrmc@gmail.com | WhatsApp:3122328116| Villavicencio - Meta</p>
      <p>&copy; 2025 EscobARQ | Todos los derechos reservados</p>
    </footer>
  </div>
</body>

<script>
  document.getElementById("clienteFormUpdate").addEventListener("submit", function (e) {
    e.preventDefault(); // Evita recargar la página

    const form = e.target;
    const datos = new FormData(form);
    const mensaje = document.getElementById("mensaje");

    fetch("actualizar.php", {
      method: "POST",
      body: datos
    })
      .then(res => res.text())
      .then(respuesta => {
        mensaje.innerText = respuesta;
        mensaje.style.display = "block";

        if (respuesta.toLowerCase().includes("exitosamente")) {
          mensaje.style.backgroundColor = "green";

          // Vaciar campos manualmente
          form.querySelectorAll("input, select").forEach(campo => {
            if (campo.type !== "hidden" && campo.type !== "submit") {
              campo.value = "";
            }
          });

        } else {
          mensaje.style.backgroundColor = "red";
        }

        setTimeout(() => mensaje.style.display = "none", 10000);
      })
      .catch(error => {
        mensaje.innerText = "Ocurrió un error al actualizar el cliente.";
        mensaje.style.display = "block";
        mensaje.style.backgroundColor = "red";
        setTimeout(() => mensaje.style.display = "none", 10000);
      });
  });
</script>


</html>

<?php
$conn->close();
?>