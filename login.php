<?php
session_start(); // Iniciar sesión para recordar al usuario si ha iniciado sesión

// Conectar a la base de datos
$host = 'localhost';
$dbname = 'trivial_game';
$user = 'root'; // Cambia esto si tienes otro usuario
$password = ''; // Cambia esto si tienes una contraseña establecida

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    // Buscar el usuario en la base de datos
    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE nombre = :nombre');
    $stmt->bindParam(':nombre', $nombre);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        // Contraseña correcta, iniciar sesión
        $_SESSION['usuario'] = $usuario['nombre'];
        echo '¡Inicio de sesión exitoso!';
        // Redirigir a la página de inicio del juego
        header('Location: inicio.php');
        exit;
    } else {
        // Error en la autenticación
        echo 'Nombre de usuario o contraseña incorrectos';
    }
}
?>