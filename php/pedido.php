<?php
// Incluir la conexión a la base de datos
include 'conexion_be.php';

// Activar el reporte de errores para facilitar la depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar la conexión
if ($conexion->connect_error) {
    error_log("Conexión fallida: " . $conexion->connect_error);
    die("Conexión fallida: " . $conexion->connect_error);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['eliminar_pedido'])) {
    $detalle_id = $_POST['detalle_id'];
    $query_detalle = "SELECT ID FROM detallepedido WHERE id = ?";
    $stmt = $conexion->prepare($query_detalle);
    $stmt->bind_param("i", $detalle_id);
    $stmt->execute();
    $result_detalle = $stmt->get_result();
    if ($result_detalle->num_rows > 0) {
        $fila_detalle = $result_detalle->fetch_assoc();
        $id_pedido = $fila_detalle['ID'];


        $query_eliminar_detalle = "DELETE FROM detallepedido WHERE id_pedido = ?";
        $stmt = $conexion->prepare($query_eliminar_detalle);
        $stmt->bind_param("i", $id_pedido);
        $stmt->execute();

        $query_eliminar_pedido = "DELETE FROM pedidos WHERE id = ?";
        $stmt = $conexion->prepare($query_eliminar_pedido);
        $stmt->bind_param("i", $id_pedido);
        $stmt->execute();

        echo "<script>alert('Pedido eliminado exitosamente.');</script>";
    } else {
        echo "<script>alert('No se pudo encontrar el pedido asociado.');</script>";
    }
    $stmt->close();
}

// Consulta para obtener la fecha del pedido, nombre del producto, precio, imagen, cantidad, total, y datos del usuario
$query = "
    SELECT dp.id AS detalle_id, dp.cantidad, dp.total, p.fecha, pr.nombre AS producto_nombre, pr.precio, pr.imagen,
           u.nombres AS usuario_nombre, u.correo, u.telefono, u.direccion
    FROM detallepedido dp
    LEFT JOIN pedidos p ON dp.id_pedido = p.id
    LEFT JOIN productos pr ON dp.id_producto = pr.id
    LEFT JOIN usuarios u ON dp.id_usuarios = u.id
";
$resultado = $conexion->query($query);

// Estilos CSS para la tabla
// Estilos CSS para la tabla
echo "<style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1.0em; /* Tamaño de la fuente */
            margin: 20px 0; /* Espacio alrededor de la tabla */
            font-family: Georgia, serif; /* Tipo de letra */
        }
        th, td {
            padding: 15px; /* Espacio dentro de cada celda */
            border: 1px solid black; /* Bordes de color negro */
            text-align: center;
            color: black; /* Texto en color negro */
            font-weight: 400; /* Grosor de la letra */
        }
        th {
            background-color: #ff796a; /* Fondo rojo claro */
            font-weight: bold; /* Grosor de la letra en encabezados */
            font-size: 1.3em; /* Tamaño de letra en encabezados */
            font-family: 'Georgia', serif; /* Tipo de letra diferente para encabezados */
        }
        td {
            font-style: italic; /* Estilo cursivo para celdas */
        }
        img {
            width: 100px; /* Tamaño de las imágenes */
            height: 100px;
            object-fit: cover;
        }
      </style>";

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Mostrar encabezados de la tabla
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Fecha del Pedido</th>";
    echo "<th>Producto</th>";
    echo "<th>Precio</th>";
    echo "<th>Imagen</th>";
    echo "<th>Cantidad</th>";
    echo "<th>Total</th>";
    echo "<th>Nombre del Usuario</th>";
    echo "<th>Correo</th>";
    echo "<th>Teléfono</th>";
    echo "<th>Direccion</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Mostrar cada registro del detalle del pedido
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . ($fila['fecha'] ?? 'Sin fecha') . "</td>";
        echo "<td>" . ($fila['producto_nombre'] ?? 'Sin producto') . "</td>";
        echo "<td>" . ($fila['precio'] ?? 'Sin precio') . "</td>";
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($fila['imagen'] ?? '') . "' alt='" . ($fila['producto_nombre'] ?? 'Imagen no disponible') . "'></td>";
        echo "<td>" . ($fila['cantidad'] ?? 'Sin cantidad') . "</td>";
        echo "<td>" . ($fila['total'] ?? 'Sin total') . "</td>";
        echo "<td>" . ($fila['usuario_nombre'] ?? 'Sin nombre de usuario') . "</td>";
        echo "<td>" . ($fila['correo'] ?? 'Sin correo') . "</td>";
        echo "<td>" . ($fila['telefono'] ?? 'Sin teléfono') . "</td>";
        echo "<td>" . ($fila['direccion'] ?? 'Sin Direccion') . "</td>";
        echo "<td>";
        echo "<form method='POST' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este pedido?\");'>";
        echo "<input type='hidden' name='detalle_id' value='" . $fila['detalle_id'] . "'>";
        echo "<button type='submit' name='eliminar_pedido' style='background-color: red; color: white; padding: 5px 10px; border: none;'>Eliminar</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "No hay detalles de pedidos disponibles.";
}

// Cerrar la conexión
$conexion->close();
?>