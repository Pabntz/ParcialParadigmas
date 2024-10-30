<?php

// Mostrar errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Procesar el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $direccion = $_POST['direccion'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validación del número de teléfono (debe tener 11 dígitos)
  if (!preg_match('/^\d{11}$/', $telefono)) {
    $error_msg = "El número de teléfono debe tener exactamente 11 dígitos.";
  } 
  // Validar que las contraseñas coincidan
  elseif ($password !== $confirm_password) {
    $error_msg = "Las contraseñas no coinciden.";
  } else {
    // Cifrar la contraseña antes de guardarla en la base de datos
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $dbpassword = ""; // Cambiar según tu configuración
    $dbname = "paradigmas";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
      die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el nombre, correo o teléfono ya existe
    $sql = "SELECT * FROM usuario WHERE nombre = ? OR correo = ? OR telefono = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $telefono);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $error_msg = "Ya existe un usuario con ese nombre, correo o teléfono.";
    } else {
      // Insertar el nuevo usuario en la tabla `usuario`
      $sql = "INSERT INTO usuario (nombre, correo, telefono, direccion, estado, fecha_alta, contraseña) 
                    VALUES (?, ?, ?, ?, 1, CURDATE(), ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssiss", $nombre, $email, $telefono, $direccion, $hashed_password);
      if ($stmt->execute()) {
        header('Location: pb_login.php');
        exit();
      } else {
        $error_msg = "Error en el registro.";
      }
    }

    $conn->close();
  }
}
?> 

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Inmobiliaria Juan Perez</title>
  <link rel="stylesheet" href="./css/pb_index.css">
  <link rel="stylesheet" href="./css/pb_login.css">
</head>
<body>
  <!-- Navbar -->
  <div class="header1">
    <header>
      <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
      <img src="./inmobiliaria/pb_logo.png" alt="Logo" class="logo" />
      <div class="title">Inmobiliaria</div>
    </header>
  </div>

  <aside id="menuAside">
    <ul>
      <li><a href="pb_login.php">Iniciar Sesión</a></li>
    </ul>
  </aside>

  <!-- Contenedor del registro -->
  <div class="login-container">
    <form class="login-form" action="pb_register.php" method="POST">
      <h2>Registro</h2>

      <!-- Mostrar mensaje de error si existe -->
      <?php if (!empty($error_msg)): ?>
        <div class="error-msg">
          <?php echo $error_msg; ?>
        </div>
      <?php endif; ?>

      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" required />

      <label for="email">Correo Electrónico</label>
      <input type="email" id="email" name="email" required />

      <label for="telefono">Teléfono</label>
      <input type="text" id="telefono" name="telefono" pattern="\d{11}" title="El número de teléfono debe tener 11 dígitos" required />

      <label for="direccion">Dirección</label>
      <input type="text" id="direccion" name="direccion" />

      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" required />

      <label for="confirm_password">Confirmar Contraseña</label>
      <input type="password" id="confirm_password" name="confirm_password" required />

      <button type="submit">Registrarse</button>
      <div class="link-register">¿Ya tienes una cuenta? <a href="pb_login.php">Inicia sesión aquí</a></div>
    </form>
  </div>

  <footer></footer>

  <script src="./javascript/pb_main.js"></script>
</body>
</html>
