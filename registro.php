<?php

$host = 'localhost';
$dbname = 'trivial';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $repeatPassword = trim($_POST['repeat_password']);

    
    if (empty($name) || empty($email) || empty($password) || empty($repeatPassword)) {
        echo "Todos los campos son obligatorios.";
    } elseif ($password !== $repeatPassword) {
        echo "Las contraseñas no coinciden.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no es válido.";
    } else {
       
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

       
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPassword]);
            header("Location: usuarios.html");
            exit;
        } catch (PDOException $e) {
            echo "Error al registrar: " . $e->getMessage();
        }
    }
}
?>