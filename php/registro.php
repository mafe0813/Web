<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conexion_be.php';  // Asegúrate de que este archivo exista y esté correctamente configurado

// Verificar conexión a la base de datos
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['dir'];
    $password = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    

    // Verificar si el correo ya existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Redirigir a la página de error si el usuario ya existe
        header("Location: /site/NoRegistro.html");
        exit();
    } else {
        // Generar token de activación y establecer fecha de expiración (10 minutos)
        $token = bin2hex(random_bytes(16));
        $token_expira = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        // Insertar usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombres, apellidos, correo, telefono, direccion, contraseña, token, token_expira, activo) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssssss", $nombres, $apellidos, $correo, $telefono, $direccion, $password, $token, $token_expira);

        // Verificar si la inserción fue exitosa
        if ($stmt->execute()) {
            // Enviar correo con el enlace de activación usando PHPMailer
            $mail = new PHPMailer(true); // Crear una instancia de PHPMailer

            try {
                // Configuración del servidor
                $mail->isSMTP(); // Configurar para usar SMTP
                $mail->Host       = 'smtp.gmail.com'; // Especificar el servidor SMTP de Gmail
                $mail->SMTPAuth   = true; // Habilitar la autenticación SMTP
                $mail->Username   = 'mfor08@gmail.com'; // Tu dirección de correo electrónico
                $mail->Password   = 'qocw ziou slcg iydp'; // Usa una contraseña de aplicación
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilitar la encriptación TLS
                $mail->Port       = 587; // Puerto TCP a usar

                // Remitente y destinatario
                $mail->setFrom('mfor08@gmail.com', 'Tu Nombre'); // Cambia esto según corresponda
                $mail->addAddress($correo, $nombres); // Añadir el correo del usuario

                // Contenido
                $mail->isHTML(true); // Configurar el formato de correo como HTML
                $mail->Subject = 'Activa tu cuenta'; // Asunto del correo
                $enlace_activacion = "http://localhost/web/site/php/activar.php?token=" . $token;
                $mail->Body = "Hola $nombres, por favor activa tu cuenta haciendo clic en el siguiente enlace: <a href='$enlace_activacion'>$enlace_activacion</a><br>Este enlace es válido por 10 minutos."; // Contenido del correo

                // Enviar el correo
                $mail->send();
                echo "<script>alert('Revisa tu correo para activar tu cuenta.'); window.location.href='http://localhost/web/site/iniciarSesion.html';</script>";
            } catch (Exception $e) {
                echo "El mensaje no se pudo enviar. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>alert('Error al registrar el usuario.'); window.location.href='http://localhost/web/site/Registro.html';</script>";
        }
    }

    $conexion->close();
}
?>
