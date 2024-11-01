<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ejemplo de archivo de inicio de sesión
session_start(); // Asegúrate de que esto esté al inicio

include 'conexion_be.php';

if ($conexion->connect_error) {
    error_log("Conexión fallida: " . $conexion->connect_error);
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contrasena = $_POST['contraseña'];

    error_log("Correo recibido: $correo");

    // Consulta para verificar el usuario y obtener nombre, apellido e id_cargo
    $query = "SELECT contraseña, activo, nombres, apellidos, id_cargo FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($query);
    
    if (!$stmt) {
        error_log("Error en la preparación de la consulta: " . $conexion->error);
        die("Error en la preparación de la consulta.");
    }

    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    error_log("Número de filas encontradas: " . $resultado->num_rows);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Verifica el valor de id_cargo y activo en los registros de error
        error_log("Valor de id_cargo: " . $usuario['id_cargo']);
        error_log("Valor de activo: " . $usuario['activo']);

        if ($usuario['activo'] == 1 && password_verify($contrasena, $usuario['contraseña'])) {
            $_SESSION['nombres'] = $usuario['nombres'];
            $_SESSION['apellidos'] = $usuario['apellidos'];
            $_SESSION['correo'] = $correo;
            $_SESSION['id_cargo'] = $usuario['id_cargo'];
            $_SESSION['estado_sesion'] = 1; // Establecer el estado de la sesión

            // Actualiza el estado de sesión en la base de datos
            $updateQuery = "UPDATE usuarios SET estado_sesion = 1 WHERE correo = ?";
            $updateStmt = $conexion->prepare($updateQuery);
            $updateStmt->bind_param("s", $correo);
            $updateStmt->execute();
            $updateStmt->close();

            error_log("Inicio de sesión exitoso para el correo: $correo");

            // Redirigir a una página específica solo si el correo es carnesbyr@gmail.com y el id_cargo es 1
            if ($correo === 'carnesbyr@gmail.com' && $usuario['id_cargo'] == 1) {
                error_log("Redirigiendo a admin.html");
                header("Location: http://localhost/web/site/admin.html");
            } else {
                error_log("Redirigiendo a index2.html");
                header("Location: http://localhost/web/site/index2.php");
            }
            exit();
        } else {
            error_log("Credenciales incorrectas o usuario inactivo para el correo: $correo");
            echo "<script>alert('Credenciales incorrectas o usuario inactivo. Intenta de nuevo.');</script>";
            header("Location: ../NoinicoSesion.html");
            exit();
        }
    } else {
        error_log("No se encontró el usuario con el correo: $correo");
        echo "<script>alert('Credenciales incorrectas. Intenta de nuevo.');</script>";
        header("Location: ../NoinicoSesion.html");
        exit();
    }
}

mysqli_close($conexion);
?>
