<?php
// Datos de conexión
$servidor = "localhost";  // Cambia esto según tu servidor MySQL
$usuario = "root";        // Usuario de MySQL
$password = "";           // Contraseña de MySQL

// Nombre de la base de datos
$nombreBD = "mi_base_datos";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password);

// Verificar si la conexión ha fallado
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Crear la base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS $nombreBD";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada correctamente<br>";
} else {
    echo "Error al crear la base de datos: " . $conn->error . "<br>";
}

// Seleccionar la base de datos
$conn->select_db($nombreBD);

// Crear la tabla de usuarios con campo 'is_admin'
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) DEFAULT 0 -- 0 para usuario normal, 1 para administrador
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'usuarios' creada correctamente<br>";
} else {
    echo "Error al crear la tabla: " . $conn->error . "<br>";
}

// Guardar la información de conexión en un archivo
$datosConexion = "<?php\n";
$datosConexion .= "\$servidor = '$servidor';\n";
$datosConexion .= "\$usuario = '$usuario';\n";
$datosConexion .= "\$password = '$password';\n";
$datosConexion .= "\$nombreBD = '$nombreBD';\n";
$datosConexion .= "?>";


// Verificar si la carpeta 'config' existe, si no, crearla
if (!file_exists('config')) {
    mkdir('config', 0777, true);
}

// Guardar el archivo de conexión en la carpeta 'config'
$file = 'config/conexion.php';
if (file_put_contents($file, $datosConexion)) {
    echo "Datos de conexión guardados en 'config/conexion.php'<br>";
} else {
    echo "Error al guardar los datos de conexión<br>";
}

// Cerrar la conexión
$conn->close();
?>
