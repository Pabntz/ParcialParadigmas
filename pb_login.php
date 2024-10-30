<?php
session_start(); // Iniciar la sesión

// Parámetros de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Cambiar según tu configuración
$dbname = "paradigmas";

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión a la base de datos fue exitosa
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

$error_msg = ""; // Variable para almacenar el mensaje de error

// Procesar los datos enviados por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input_email = $_POST['username']; // El correo ingresado en el formulario
  $input_password = $_POST['password']; // La contraseña ingresada en el formulario

  // Verificar si el correo existe
  $sql = "SELECT * FROM usuario WHERE correo = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $input_email);
  $stmt->execute();
  $result = $stmt->get_result();

  // Verificar si se encontró el usuario
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verificar la contraseña
    if ($row['contraseña'] == $input_password) {
      // Credenciales correctas, iniciar la sesión
      $_SESSION['usuario'] = $row['nombre']; // Guardar el nombre del usuario en la sesión
      $_SESSION['email'] = $row['correo']; // Guardar el correo del usuario
      $_SESSION['usuario_id'] = $row['usuario_id']; // Guardar el ID del usuario en la sesión

      // Insertar un nuevo registro en la tabla `sesiones_usuario` para registrar el inicio de sesión
      $sql = "INSERT INTO sesiones_usuario (usuario_id, hora_inicio) VALUES (?, NOW())";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $_SESSION['usuario_id']);
      $stmt->execute();

      // Redirigir al index.php
      header('Location: index.php');
      exit(); // Detener el script
    } else {
      $error_msg = "Credenciales incorrectas";
    }
  } else {
    $error_msg = "Credenciales incorrectas";
  }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar Sesión - Inmobiliaria Juan Perez</title>
  <link rel="stylesheet" href="./css/pb_index.css" />
  <link rel="stylesheet" href="./css/pb_login.css" />
</head>

<body>
  <div class="header1">
    <header>
      <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
      <img src="./inmobiliaria/pb_logo.png" alt="Logo" class="logo" />
      <div class="title">Inmobiliaria Juan Perez</div>
    </header>
  </div>

  <aside id="menuAside">
    <ul>
      <li><a href="pb_login.php">Iniciar Sesión</a></li>
    </ul>
  </aside>

  <div class="login-container">
    <form class="login-form" action="pb_login.php" method="POST">
      <h2>Iniciar Sesión</h2>

      <!-- Mostrar mensaje de error si existe -->
      <?php if (!empty($error_msg)): ?>
        <div class="error-msg">
          <?php echo $error_msg; ?>
        </div>
      <?php endif; ?>

      <label for="username">Correo</label>
      <input type="text" id="username" name="username" required />
      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" required />
      <button type="submit">Ingresar</button>
      <div class="link-register">¿No tienes una cuenta? <a href="pb_register.php"> Regístrate aqui</a></div>
    </form>

  </div>

  <footer></footer>

  <script src="./javascript/pb_main.js"></script>
</body>

</html>