<?php
session_start(); // Iniciar la sesión

// Verificar si hay un usuario logueado
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de Cursos - Box</title>
  <link rel="stylesheet" href="css/pb_listado_box.css">
  <link rel="stylesheet" href="css/pb_index.css">
</head>

<body>
  <div class="header1">
    <header>
      <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
      <img src="./inmobiliaria/pb_logo.png" alt="Logo" class="logo" />
      <div class="title">Inmobiliaria Juan Perez</div>
      <div class="busuario">Bienvenido, <?php echo $usuario; ?>!</div>

      <div class="user-dropdown">
        <img
          src="./imagenes/user_perfile-removebg-preview.png"
          alt="Imagen de Usuario"
          class="user-icon"
          onclick="toggleUserMenu()" />
        <div id="userMenu" class="user-dropdown-content">
          <a href="#">Área personal</a>
          <a href="#">Perfil</a>
          <a href="#">Calificaciones</a>
          <a href="#">Mensajes</a>
          <a href="#">Preferencias</a>
          <a href="pb_logout.php">Cerrar sesión</a> <!-- Link para cerrar sesión -->
        </div>
      </div>
    </header>
  </div>
  <aside id="menuAside">
    <ul>
      <li><a href="pb_index.php">Inicio</a></li>
      <li><a href="pb_listado_tabla.php">PropiedadesT</a></li>
      <li><a href="pb_listado_box.php">PropiedadesB</a></li>
    </ul>
  </aside>

  <div class="separator"></div>

  <div class="container">

    <article class="presentacion">

      <img src="./inmobiliaria/pb_depto1.jpg" alt="Descripción de la imagen" class="imagen">
      <div class="descripcion">
        <h2>Departamento destacado</h2>
        <p>Ubicación: New York City</p>
      </div>

    </article>



    <article class="presentacion">

      <img src="./inmobiliaria/pb_depto2.jpg" alt="Descripción de la imagen" class="imagen">
      <div class="descripcion">
        <h2>Departamento en Ofeta!!</h2>
        <p>Ubicación: Manhatann</p>
      </div>

    </article>
  </div>

  <script src="./javascript/pb_main.js"></script>
</body>

</html>