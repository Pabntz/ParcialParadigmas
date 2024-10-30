<?php
session_start(); // Iniciar la sesión

// Verificar si hay un usuario logueado
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inmobiliaria</title>
  <link rel="stylesheet" href="./css/pb_index.css" />
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

  <div class="news-carousel-container">
    <div class="news-carousel">
      <div class="news-item">
        <img
          src="inmobiliaria/pb_depto1.jpg"
          alt="Noticia 1"
          class="news-image" />
        <div class="news-description">
          <h2>Departamento destacacado</h2>
          <p>1999$</p>
        </div>
      </div>
      <div class="news-item">
        <img
          src="inmobiliaria/pb_depto2.jpg"
          alt="Noticia 2"
          class="news-image" />
        <div class="news-description">
          <h2>Departamento destacado</h2>
          <p>
            2999$
          </p>
        </div>
      </div>
      <div class="news-item">
        <img
          src="inmobiliaria/pb_depto3.jpeg"
          alt="Noticia 3"
          class="news-image" />
        <div class="news-description">
          <h2>Departamento destacado</h2>
          <p>
            10000$
          </p>
        </div>
      </div>
    </div>
  </div>

  <footer></footer>

  <script src="./javascript/pb_main.js"></script>
</body>

</html>