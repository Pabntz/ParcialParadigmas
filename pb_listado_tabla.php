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
    <title>Listado de Cursos - Tabla</title>
    <link rel="stylesheet" href="css/pb_index.css">
    <link rel="stylesheet" href="css/pb_listado_tabla.css">
</head>
<body>
<div class="header1">
    <header>
      <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
      <img src="./inmobiliaria/pb_logo.png" alt="Logo" class="logo" />
      <div class="title">Inmobiliaria</div>
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

    <table>
        <thead>
            <tr>
                <th>Nombre del dueño</th>
                <th>Descripción</th>
                <th>Disponibilidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tomás Kugelmann</td>
                <td>Departamento expectacular con vista al rio Nilo</td>
                <td>10/10/24 - 25/12/24</td>
                <td>19000$ x noche</td>
            </tr>
            <tr>
                <td>Alejo Sanabria</td>
                <td>Departamento Genial a las orillas del rio Eufrates</td>
                <td>10/10/24 - 25/11/24</td>
                <td>150000 x dia</td>
            </tr>
            <tr>
                <td>Pablo Benitez</td>
                <td>Departamento en el centro de Nueva York</td>
                <td>10/11/24 - 25/12/24</td>
                <td>25000$</td>
            </tr>
        </tbody>
    </table>

    <script src="./javascript/pb_main.js"></script>
</body>
</html>
