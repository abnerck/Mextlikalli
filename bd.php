<?php
$servername = "localhost"; // o "127.0.0.1"
$username = "root"; // Usuario predeterminado de XAMPP
$password = ""; // Contraseña predeterminada de XAMPP es generalmente vacía
$dbname = "mextlikalli";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['introducir_nombre'];
$email = $_POST['introducir_email'];
$telefono = $_POST['introducir_telefono'];
$asunto = $_POST['introducir_asunto'];
$mensaje = $_POST['introducir_mensaje'];

// Preparar la consulta SQL para insertar datos en la tabla
$stmt = $conn->prepare("INSERT INTO formulario_contacto (nombre, email, telefono, asunto, mensaje)
                        VALUES (?, ?, ?, ?, ?)");

// Vincular parámetros
$stmt->bind_param('sssss', $nombre, $email, $telefono, $asunto, $mensaje);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Mensaje de éxito
    
    
    // Redirigir a index.html después de 2 segundos
    header("refresh:2;url=index.html");
} else {
    // En caso de error, mostrar el mensaje de error
    echo "Error: " . $stmt->error;
}

$to = "abnerck9@gmail.com";  // Reemplaza con tu dirección de correo
$subject = "Nuevo formulario enviado";
$message = "Se ha recibido un nuevo formulario de:\n\n";
$message .= "Nombre: $nombre\n";
$message .= "Email: $email\n";
$message .= "Teléfono: $telefono\n";


// Cerrar la conexión y liberar recursos
$stmt->close();
$conn->close();
?>
