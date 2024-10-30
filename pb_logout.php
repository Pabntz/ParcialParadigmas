<?php
session_start();

// Parámetros de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Cambiar según tu configuración
$dbname = "paradigmas";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión a la base de datos fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Registrar la hora de fin de la sesión actual
$sql = "UPDATE sesiones_usuario 
        SET hora_fin = NOW() 
        WHERE usuario_id = ? 
        AND hora_fin IS NULL"; // Actualizar solo la sesión activa
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();

// Cerrar la sesión del usuario
session_destroy(); // Destruir la sesión actual
header('Location: pb_login.php'); // Redirigir al login
exit();
