<?php

include 'conexion_be.php';
// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Buscar usuario por token y verificar que aún no esté activo
    $sql = "SELECT id, token_expira FROM usuarios WHERE token = ? AND activo = 0";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        $fecha_actual = date("Y-m-d H:i:s");
        
        // Verificar si el token ha expirado
        if ($fecha_actual < $usuario['token_expira']) {
            // Actualizar el estado del usuario a activo
            $sql = "UPDATE usuarios SET activo = 1, token = NULL, token_expira = NULL WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $usuario['id']);
            $stmt->execute();
            header("Location: http://localhost/web/site/activacion_exitosa.html");
            exit();
        } else {
            echo "El enlace de activación ha expirado.";
        }
    } else {
        echo "Token no válido o la cuenta ya está activada.";
    }
}
?>


