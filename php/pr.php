<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conexion_be.php';

// Verificar la conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Lógica para agregar al carrito
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['producto_id'])) {
  // Obtener el correo del usuario desde la sesión
  $correo = $_SESSION['correo'];

  // Obtener el ID del usuario basado en el correo
  $usuarioQuery = "SELECT id, estado_sesion FROM usuarios WHERE correo = ?";
  $usuarioStmt = $conexion->prepare($usuarioQuery);
  $usuarioStmt->bind_param("s", $correo);
  $usuarioStmt->execute();
  $usuarioResult = $usuarioStmt->get_result();

  if ($usuarioResult->num_rows == 1) {
    $usuario = $usuarioResult->fetch_assoc();

    // Solo permitir agregar al carrito si el estado de sesión es 1
    if ($usuario['estado_sesion'] == 1) {
      $producto_id = $_POST['producto_id'];
      $nombre = $_POST['nombre'];
      $precio = $_POST['precio'];
      $cantidad = $_POST['cantidad']; // Ahora capturamos la cantidad del formulario

      // Verificar si el carrito está inicializado en la sesión
      if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
      }

      // Agregar el producto al carrito (sesión)
      $producto_encontrado = false;

      // Comprobar si el producto ya está en el carrito
      foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] == $producto_id) {
          $item['cantidad'] += $cantidad; // Sumar la nueva cantidad
          $producto_encontrado = true;
          break;
        }
      }

      // Si el producto no se encontró, agregarlo
      if (!$producto_encontrado) {
        $_SESSION['carrito'][] = [
          'id' => $producto_id,
          'nombre' => $nombre,
          'precio' => $precio,
          'cantidad' => $cantidad
        ];
      }

      echo "<script>alert('Producto agregado al carrito.');</script>";
    } else {
      echo "<script>alert('No tienes permiso para agregar productos al carrito.');</script>";
    }
  } else {
    echo "<script>alert('No se encontró el usuario.');</script>";
  }
}

// Consulta para obtener productos
$sql = "SELECT id, nombre, precio, imagen FROM productos";
$result = $conexion->query($sql);

if (!isset($_SESSION['nombres']) || !isset($_SESSION['apellidos'])) {
  header("Location: ../NoinicoSesion.html");
  exit();
}
$nombres = $_SESSION['nombres'];
$apellidos = $_SESSION['apellidos'];
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title>Productos</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport"
    content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="images/icono.jpeg" type="image/x-icon">
  <!-- Stylesheets-->
  <link rel="stylesheet" type="text/css"
    href="//fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,600,700,900%7CRaleway:500">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="../css/estilos.css">
  <style>
    .productos {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 5px;
      justify-content: center;
      padding: 20px;
    }

    .productos {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      justify-content: center;
      padding: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .producto {
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 15px;
      text-align: center;
      transition: transform 0.2s ease-in-out;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-color: white;
    }

    .producto:hover {
      transform: scale(1.02);
    }

    .producto img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .producto h7 {
      font-size: 1.1rem;
      margin: 10px 0;
      color: #333;
    }

    .producto p {
      margin: 8px 0;
      color: #666;
    }

    .producto form {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      width: 100%;
    }

    .cantidad-container {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
      margin: 10px 0;
    }

    input[type="number"] {
      width: 60px;
      height: 30px;
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 0 5px;
      font-size: 0.9rem;
    }

    .cantidad-btn {
      background-color: #ff4c4c;
      color: white;
      border: none;
      border-radius: 4px;
      width: 30px;
      height: 30px;
      cursor: pointer;
      font-size: 1.2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s;
    }

    .cantidad-btn:hover {
      background-color: #ff3333;
    }

    .agregar-carrito {
      background-color: #ff4c4c;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
      width: 80%;
      font-size: 0.9rem;
      margin-top: 10px;
    }

    .agregar-carrito:hover {
      background-color: #ff3333;
    }

    @media (max-width: 1200px) {
      .productos {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 768px) {
      .productos {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 480px) {
      .productos {
        grid-template-columns: 1fr;
      }
    }

    .agregar-carrito {
      background-color: #ff4c4c;
      color: white;
      padding: 8px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .agregar-carrito:hover {
      background-color: #ff3333;
    }

    @media (max-width: 768px) {
      .rd-navbar-nav {
        flex-direction: column;
      }

      .nav-actions {
        margin-left: 0;
        margin-top: 10px;
      }
    }

    .rd-navbar-nav {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-left: 20px;
    }

    .cart-button {
      padding: 20px 16px;
      border-radius: 4px;
      text-decoration: none;
      color: white;
      background-color: #ff4c4c;
      transition: background-color 0.3s;
    }

    .cart-button img {
      max-width: 100%;
      max-height: 100%;
    }

    .cart-button:hover {
      background-color: #ffab6a;
      color: rgb(11, 11, 11);
    }

    .login-button {
      padding: 8px 16px;
      border-radius: 4px;
      text-decoration: none;
      color: white;
      background-color: #ff4c4c;
      transition: background-color 0.3s;
    }

    .login-button:hover {
      background-color: #ffab6a;
      color: rgb(15, 15, 15);
    }

    @media (max-width: 768px) {
      .rd-navbar-nav {
        flex-direction: column;
      }

      .nav-actions {
        margin-left: 0;
        margin-top: 10px;
      }
    }
  </style>
</head>

<body>
  <div class="preloader">
    <div class="wrapper-triangle">
      <div class="pen">
        <div class="line-triangle">
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
        </div>
        <div class="line-triangle">
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
        </div>
        <div class="line-triangle">
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
          <div class="triangle"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="page">
    <!-- Page Header-->
    <header class="section page-header">
      <!-- RD Navbar-->
      <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
          data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
          data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
          data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
          data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="56px" data-xl-stick-up-offset="56px"
          data-xxl-stick-up-offset="56px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
          <div class="rd-navbar-inner-outer">
            <div class="rd-navbar-inner">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand"><a class="brand" href="../index.html"><img class="brand-logo-dark"
                      src="../images/logoC.png" alt="" width="198" height="66" /></a></div>
              </div>
              <div class="rd-navbar-right rd-navbar-nav-wrap">
                <div class="rd-navbar-aside">
                  <ul class="rd-navbar-contacts-2">
                    <li>
                      <div class="unit unit-spacing-xs">
                        <div class="unit-left"><span class="icon mdi mdi-phone"></span></div>
                        <div class="unit-body"><a class="phone" href="tel:#">+57 3182575587</a></div>
                      </div>
                    </li>
                    <li>
                      <div class="unit unit-spacing-xs">
                        <div class="unit-left"><span class="icon mdi mdi-map-marker"></span></div>
                        <div class="unit-body"><a class="address" href="#">Calle 79b#70A-31</a></div>
                      </div>
                    </li>
                  </ul>
                  <ul class="list-share-2">
                    <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                    <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                    <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                    <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
                  </ul>
                </div>
                <div class="rd-navbar-main">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item active"><a class="rd-nav-link" href="../index2.php">Inicio</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../about2.php">Sobre Nosotros</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="php/pr.php">Productos</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../contacts2.php">Contáctanos</a></li>

                    <div class="nav-actions">
                    <h5><?php echo htmlspecialchars($nombres ); ?></h5>
                      <a href="../cerarSesion.php" class="btn btn-primary login-button">Cerrar sesion</a>
                      <a href="cart.php" class="cart-button">
                        <img src="images/carro1.png" width="20" height="20" alt="Carrito" />
                      </a>
                    </div>
                </div>
                </ul>
              </div>
              </ul>
            </div>
          </div>
    </header>

    <body>
      <main>
        <div class="productos">
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='producto'>
            <img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' alt='{$row['nombre']}'>
            <h7><strong>{$row['nombre']}</strong></h7>
            <p>Precio: $ {$row['precio']} kilo</p>
            <form method='POST' action=''>
                <input type='hidden' name='producto_id' value='{$row['id']}'>
                <input type='hidden' name='nombre' value='{$row['nombre']}'>
                <input type='hidden' name='precio' value='{$row['precio']}'>
                <div class='cantidad-container'>
                    <button type='button' class='cantidad-btn disminuir'>-</button>
                    <input type='number' name='cantidad' min='1' value='1'>
                    <button type='button' class='cantidad-btn aumentar'>+</button>
                </div>
                <button type='submit' class='agregar-carrito'>Agregar al carrito</button>
            </form>
          </div>";
            }
          } else {
            echo "<p>No hay productos disponibles.</p>";
          }
          ?>

        </div>
      </main>
      <script src="../js/core.min.js"></script>
      <script src="../js/script.js"></script>
      <script src="../js/registro.js"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const productos = document.querySelectorAll('.producto');

          productos.forEach(producto => {
            const disminuirBtn = producto.querySelector('.disminuir');
            const aumentarBtn = producto.querySelector('.aumentar');
            const cantidadInput = producto.querySelector('input[type="number"]');

            function actualizarCantidad(valor) {
              let cantidad = parseInt(cantidadInput.value);
              cantidad += valor;

              if (cantidad < 1) cantidad = 1;
              if (cantidad > 99) cantidad = 99;

              cantidadInput.value = cantidad;
            }

            disminuirBtn.addEventListener('click', () => actualizarCantidad(-1));
            aumentarBtn.addEventListener('click', () => actualizarCantidad(1));

            cantidadInput.addEventListener('change', function () {
              let cantidad = parseInt(this.value);

              if (isNaN(cantidad)) {
                cantidad = 1;
              }

              if (cantidad < 1) cantidad = 1;
              if (cantidad > 99) cantidad = 99;

              this.value = cantidad;
            });

            cantidadInput.addEventListener('keypress', function (e) {
              if (!/[0-9]/.test(e.key)) {
                e.preventDefault();
              }
            });
          });
        });
      </script>
    </body>

</html>