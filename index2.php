<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombres']) || !isset($_SESSION['apellidos'])) {
    // Si no ha iniciado sesión, redirigir al inicio de sesión
    header("Location: ../NoinicoSesion.html");
    exit();
}
$nombres = $_SESSION['nombres'];
$apellidos = $_SESSION['apellidos'];
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
  <title>CARNES B&R</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport"
    content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="images/icono.jpeg" type="image/x-icon">

  <link rel="stylesheet" type="text/css"
    href="//fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,600,700,900%7CRaleway:500">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/fonts.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
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
            background-color: #ffab6a ;
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
            background-color:#ffab6a;
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
                <div class="rd-navbar-brand"><a class="brand" href="index2.html"><img class="brand-logo-dark"
                      src="logoC.png" alt="" width="198" height="66" /></a></div>
              </div>
              <div class="rd-navbar-right rd-navbar-nav-wrap">
                <div class="rd-navbar-aside">
                  <ul class="rd-navbar-contacts-2">
                    <li>
                      <div class="unit unit-spacing-xs">
                        <div class="unit-left"><span class="icon mdi mdi-phone"></span></div>
                        <div class="unit-body"><a class="phone" href="tel:#">+573182575587</a></div>
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
                  <li class="rd-nav-item active"><a class="rd-nav-link" href="index2.php">Inicio</a></li>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="about2.php">Sobre Nosotros</a></li>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="php/pr.php">Productos</a></li>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="contacts2.php">Contáctanos</a></li>
                  <li class="rd-nav-item navbar-cart">
                    <div class="nav-actions"> 
                      <h5><?php echo htmlspecialchars($nombres . ' ' . $apellidos); ?></h5>
                      <a href="cerarSesion.php" class="btn btn-primary login-button">Cerrar sesion</a>
                      <a href="php/cart.php" class="cart-button">
                          <img src="images/carro1.png" width="20" height="20" alt="Carrito"/>
                      </a>                        
                  </div>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- Swiper-->
    <section class="section swiper-container swiper-slider swiper-slider-2 swiper-slider-3" data-loop="true"
      data-autoplay="5000" data-simulate-touch="false" data-slide-effect="fade">
      <div class="swiper-wrapper text-sm-left">
        <div class="swiper-slide context-dark" data-slide-bg="images/carnes11.png">
          <div class="swiper-slide-caption section-md">
            <div class="container">
              <div class="row">
                <div class="col-sm-9 col-md-8 col-lg-7 col-xl-7 offset-lg-1 offset-xxl-0">
                  <h3 class="oh swiper-title"><span class="d-inline-block" data-caption-animate="slideInUp"
                      data-caption-delay="0">Elige tus cortes</span></h>
                    <p class="big swiper-text" data-caption-animate="fadeInLeft" data-caption-delay="300">No las unicas
                      pero si las mejores!</p><a class="button button-lg button-primary button-winona button-shadow-2"
                      href="#" data-caption-animate="fadeInUp" data-caption-delay="300">View our menu</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide context-dark" data-slide-bg="images/carnes2.png">
          <div class="swiper-slide-caption section-md">
            <div class="container">
              <div class="row">
                <div class="col-sm-8 col-lg-7 offset-lg-1 offset-xxl-0">
                  <h2 class="oh swiper-title"><span class="d-inline-block" data-caption-animate="slideInDown"
                      data-caption-delay="0">Calidad de carnes</span></h2>
                  <p class="big swiper-text" data-caption-animate="fadeInRight" data-caption-delay="300">Nuestra carne de alta calidad está disponible para ti.</p>
                  <div class="button-wrap oh"><a class="button button-lg button-primary button-winona button-shadow-2"
                      href="#" data-caption-animate="slideInUp" data-caption-delay="0">View our menu</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Swiper Pagination-->
      <div class="swiper-pagination" data-bullet-custom="true"></div>
      <!-- Swiper Navigation-->
      <div class="swiper-button-prev">
        <div class="preview">
          <div class="preview__img"></div>
        </div>
        <div class="swiper-button-arrow"></div>
      </div>
      <div class="swiper-button-next">
        <div class="swiper-button-arrow"></div>
        <div class="preview">
          <div class="preview__img"></div>
        </div>
      </div>
    </section>
    <!-- What We Offer-->
    <section class="section section-md bg-default">
      <div class="container">
        <h3 class="oh-desktop"><span class="d-inline-block wow slideInDown">PRODUCTOS DESTACADOS</span></h3>
        <div class="row row-md row-30">
          <div class="col-sm-6 col-lg-4">
            <div class="oh-desktop">
              <!-- Services Terri-->
              <article class="services-terri wow slideInUp">
                <div class="services-terri-figure"><img src="images/lomo-fino.png" alt="" width="370" height="278" />
                </div>
                <div class="services-terri-caption"><span class="services-terri-icon linearicons-steak"></span>
                  <h5 class="services-terri-title"><a href="#">Lomo fino</a></h5>
                </div>
              </article>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="oh-desktop">
              <!-- Services Terri-->
              <article class="services-terri wow slideInDown">
                <div class="services-terri-figure"><img src="images/costilla.jpg" alt="" width="370" height="278" />
                </div>
                <div class="services-terri-caption"><span class="services-terri-icon linearicons-steak"></span>
                  <h5 class="services-terri-title"><a href="#">Costillas</a></h5>
                </div>
              </article>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="oh-desktop">
              <!-- Services Terri-->
              <article class="services-terri wow slideInUp">
                <div class="services-terri-figure"><img src="images/sobre.jpeg" alt="" width="370" height="278" />
                </div>
                <div class="services-terri-caption"><span class="services-terri-icon linearicons-steak"></span>
                  <h5 class="services-terri-title"><a href="#">Sobrebarriga</a></h5>
                </div>
              </article>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="oh-desktop">
              <!-- Services Terri-->
              <article class="services-terri wow slideInDown">
                <div class="services-terri-figure"><img src="images/bola1.jpg" alt="" width="370" height="278" />
                </div>
                <div class="services-terri-caption"><span class="services-terri-icon linearicons-steak"></span>
                  <h5 class="services-terri-title"><a href="#">Bola</a></h5>
                </div>
              </article>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="oh-desktop">
              <!-- Services Terri-->
              <article class="services-terri wow slideInUp">
                <div class="services-terri-figure"><img src="images/Punta-de-Anca.png" alt="" width="370"
                    height="278" />
                </div>
                <div class="services-terri-caption"><span class="services-terri-icon linearicons-steak"></span>
                  <h5 class="services-terri-title"><a href="#">Punta de anca</a></h5>
                </div>
              </article>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="oh-desktop">
              <!-- Services Terri-->
              <article class="services-terri wow slideInDown">
                <div class="services-terri-figure"><img src="images/MURILLOSPAG.jpg" alt="" width="370" height="278" />
                </div>
                <div class="services-terri-caption"><span class="services-terri-icon linearicons-steak"></span>
                  <h5 class="services-terri-title"><a href="#">Murillo</a></h5>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section CTA-->
    <section class="primary-overlay section parallax-container" data-parallax-img="images/carnec.png">
      <div class="parallax-content section-xl context-dark text-md-left">
        <div class="container">
          <div class="row justify-content-end">
            <div class="col-sm-8 col-md-7 col-lg-5">
              <div class="cta-modern">
                <h3 class="cta-modern-title wow fadeInRight">Calidad y Servicio Superior</h3>
                <p class="lead">El lugar donde encontrarás las mejores carnes y un servicio de alta calidad..</p>
                <p class="cta-modern-text oh-desktop" data-wow-delay=".1s"><span
                    class="cta-modern-decor wow slideInLeft"></span><span class="d-inline-block wow slideInDown">Carnes
                    B&R</span></p><a class="button button-md button-secondary-2 button-winona wow fadeInUp" href="#"
                  data-wow-delay=".2s">Conoce nuestros servicios</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Shop-->
    <section class="section section-lg bg-default">
      <div class="container">
        <h3 class="oh-desktop"><span class="d-inline-block wow slideInUp">Carnes Seleccionadas</span></h3>
        <div class="row row-lg row-30">
          <div class="col-sm-6 col-lg-4 col-xl-3">
            <!-- Product-->
            <article class="product wow fadeInLeft" data-wow-delay=".15s">
              <div class="product-figure"><img src="images/CHATAS.png" alt="" width="161" height="162" />
              </div>
              <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                  class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                  class="mdi mdi-star text-gray-13"></span>
              </div>
              <h6 class="product-title">Chatas</h6>
              <div class="product-price-wrap">
                <div class="product-price">$32.000 kl</div>
              </div>
              <div class="product-button">
                <div class="button-wrap"><a class="button button-xs button-primary button-winona" href="#">Agregar al
                    carrito</a></div>
                <div class="button-wrap"><a class="button button-xs button-secondary button-winona" href="#">Ver
                    producto</a></div>
              </div>
            </article>
          </div>
          <div class="col-sm-6 col-lg-4 col-xl-3">
            <!-- Product-->
            <article class="product wow fadeInLeft" data-wow-delay=".1s">
              <div class="product-figure"><img src="images/palo.png" alt="" width="161" height="162" />
              </div>
              <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                  class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span>
              </div>
              <h6 class="product-title">Palomilla</h6>
              <div class="product-price-wrap">
                <div class="product-price">$24.00 kl</div>
              </div>
              <div class="product-button">
                <div class="button-wrap"><a class="button button-xs button-primary button-winona" href="#">Agregar al
                    carrito</a></div>
                <div class="button-wrap"><a class="button button-xs button-secondary button-winona" href="#">Ver
                    producto</a></div>
              </div><span class="product-badge product-badge-new">New</span>
            </article>
          </div>
          <div class="col-sm-6 col-lg-4 col-xl-3">
            <!-- Product-->
            <article class="product wow fadeInLeft" data-wow-delay=".05s">
              <div class="product-figure"><img src="images/carne-molida-shutterstock_316382753.png" alt="" width="161"
                  height="162" />
              </div>
              <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                  class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                  class="mdi mdi-star text-gray-13"></span>
              </div>
              <h6 class="product-title">Carne molida especial</h6>
              <div class="product-price-wrap">
                <div class="product-price">$22.000 kl</div>
              </div>
              <div class="product-button">
                <div class="button-wrap"><a class="button button-xs button-primary button-winona" href="#">Agregar al
                    carrito</a></div>
                <div class="button-wrap"><a class="button button-xs button-secondary button-winona" href="#">Ver
                    producto</a></div>
              </div>
            </article>
          </div>
          <div class="col-sm-6 col-lg-4 col-xl-3">
            <!-- Product-->
            <article class="product wow fadeInLeft">
              <div class="product-figure"><img src="images/lomo-fino.png" alt="" width="161" height="162" />
              </div>
              <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                  class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span>
              </div>
              <h6 class="product-title">Lomo fino</h6>
              <div class="product-price-wrap">
                <div class="product-price product-price-old">$43.000 kl</div>
                <div class="product-price">$32.000 kl</div>
              </div>
              <div class="product-button">
                <div class="button-wrap"><a class="button button-xs button-primary button-winona" href="#">Agregar al
                    carrito</a></div>
                <div class="button-wrap"><a class="button button-xs button-secondary button-winona" href="#">er
                    producto</a></div>
              </div><span class="product-badge product-badge-sale">Sale</span>
            </article>
          </div>
        </div>
      </div>
    </section>

    <!-- What We Offer-->
    <section class="section section-xl bg-default">
      <div class="container">
        <h3 class="wow fadeInLeft">¿Que dicen las personas?</h3>
      </div>
      <div class="container container-style-1">
        <div class="owl-carousel owl-style-12" data-items="1" data-sm-items="2" data-lg-items="3" data-margin="30"
          data-xl-margin="45" data-autoplay="true" data-nav="true" data-center="true" data-smart-speed="400">
          <!-- Quote Tara-->
          <article class="quote-tara">
            <div class="quote-tara-caption">
              <div class="quote-tara-text">
                <p class="q">La limpieza y la organización en esta carnicería son excepcionales. El lugar siempre está
                  impecable, con un enfoque claro en mantener un ambiente higiénico.</p>
              </div>
              <div class="quote-tara-figure"><img src="images/cliente7.jpeg" alt="" width="115" height="115" />
              </div>
            </div>
            <h6 class="quote-tara-author">Juliana Ramirez</h6>
            <div class="quote-tara-status">Cliente</div>
          </article>
          <!-- Quote Tara-->
          <article class="quote-tara">
            <div class="quote-tara-caption">
              <div class="quote-tara-text">
                <p class="q">Una de las razones por las que sigo volviendo a esta carnicería es el excelente servicio al
                  cliente. Los empleados son amables, y además están altamente capacitados.</p>
              </div>
              <div class="quote-tara-figure"><img src="images/cliente4.jpeg" alt="" width="115" height="115" />
              </div>
            </div>
            <h6 class="quote-tara-author">Valeria Gómez</h6>
            <div class="quote-tara-status">Cliente</div>
          </article>
          <!-- Quote Tara-->
          <article class="quote-tara">
            <div class="quote-tara-caption">
              <div class="quote-tara-text">
                <p class="q">He sido cliente de esta carnicería durante más de un año y nunca he estado decepcionado. La
                  calidad de la carne es insuperable; los cortes siempre son frescos y bien seleccionados.</p>
              </div>
              <div class="quote-tara-figure"><img src="images/cliente6.jpeg" alt="" width="115" height="115" />
              </div>
            </div>
            <h6 class="quote-tara-author">Mateo Rodríguez </h6>
            <div class="quote-tara-status">Cliente</div>
          </article>
          <!-- Quote Tara-->
          <article class="quote-tara">
            <div class="quote-tara-caption">
              <div class="quote-tara-text">
                <p class="q">La carne siempre es fresca y de excelente calidad. Se nota la diferencia en el sabor y la
                  textura en comparación con otros lugares</p>
              </div>
              <div class="quote-tara-figure"><img src="images/cliente2(1).jpeg" alt="" width="115" height="115" />
              </div>
            </div>
            <h6 class="quote-tara-author">Alejandro López</h6>
            <div class="quote-tara-status">Cliente</div>
          </article>
        </div>
      </div>
    </section>

    <section class="section section-last bg-default">
      <div class="container-fluid container-inset-0 isotope-wrap">
        <div class="row row-10 gutters-10 isotope" data-isotope-layout="masonry" data-isotope-group="gallery"
          data-lightgallery="group">
          <div class="col-xs-6 col-sm-4 col-xl-2 isotope-item oh-desktop">
            <!-- Thumbnail Mary-->
            <article class="thumbnail thumbnail-mary thumbnail-mary-2 wow slideInLeft"><a class="thumbnail-mary-figure"
                href="images/gallery-1-1200x800-original.jpg" data-lightgallery="item"><img
                  src="images/TOMAS.jpeg" alt="" width="310" height="585" /></a>
              <div class="thumbnail-mary-caption">
                <div>
                  <h6 class="thumbnail-mary-title"><a href="#">BROCHETA VERTICAL DE CARNE</a></h6>
                  <div class="thumbnail-mary-location">Delicias llenas de sabor</div>
                </div>
              </div>
            </article>
          </div>
          <div class="col-xs-6 col-sm-8 col-xl-4 isotope-item oh-desktop">
            <!-- Thumbnail Mary-->
            <article class="thumbnail thumbnail-mary thumbnail-mary-big wow slideInRight"><a
                class="thumbnail-mary-figure" href="images/gallery-2-1200x800-original.jpg"
                data-lightgallery="item"><img src="images/costillas2.jpg" alt="" width="631" height="587" /></a>
              <div class="thumbnail-mary-caption">
                <div>
                  <h6 class="thumbnail-mary-title"><a href="#">COSTILLAS EN SALSA DE CHILE</a></h6>
                  <div class="thumbnail-mary-location">Combinacion perfecta de dulcura y picante</div>
                </div>
              </div>
            </article>
          </div>
          <div class="col-xs-6 col-sm-4 col-xl-2 isotope-item oh-desktop">
            <!-- Thumbnail Mary-->
            <article class="thumbnail thumbnail-mary thumbnail-mary-2 wow slideInDown"><a class="thumbnail-mary-figure"
                href="images/gallery-3-1200x800-original.jpg" data-lightgallery="item"><img
                  src="images/lasaña.jpeg" alt="" width="311" height="289" /></a>
              <div class="thumbnail-mary-caption">
                <div>
                  <h6 class="thumbnail-mary-title"><a href="#">LASAÑA</a></h6>
                  <div class="thumbnail-mary-location">Un estallido de sabor</div>
                </div>
              </div>
            </article>
          </div>
          <div class="col-xs-6 col-sm-8 col-xl-4 isotope-item oh-desktop">
            <!-- Thumbnail Mary-->
            <article class="thumbnail thumbnail-mary wow slideInUp"><a class="thumbnail-mary-figure"
                href="images/gallery-4-1200x800-original.jpg" data-lightgallery="item"><img
                  src="images/mafe1.jpeg" alt="" width="631" height="289" /></a>
              <div class="thumbnail-mary-caption">
                <div>
                  <h6 class="thumbnail-mary-title"><a href="#">PIMIENTOS RELLENOS DE CARNE MOLIDA</a></h6>
                  <div class="thumbnail-mary-location">Seleccion exclusiva</div>
                </div>
              </div>
            </article>
          </div>
          <div class="col-xs-6 col-sm-4 col-xl-2 isotope-item oh-desktop">
            <!-- Thumbnail Mary-->
            <article class="thumbnail thumbnail-mary thumbnail-mary-2 wow slideInUp"><a class="thumbnail-mary-figure"
                href="images/gallery-5-1200x800-original.jpg" data-lightgallery="item"><img
                  src="images/ar(1).jpg" alt="" width="311" height="289" /></a>
              <div class="thumbnail-mary-caption">
                <div>
                  <h6 class="thumbnail-mary-title"><a href="#">CARNE DE RES SALTEADA</a></h6>
                  <div class="thumbnail-mary-location">Sabores exquisitos</div>
                </div>
              </div>
            </article>
          </div>
          <div class="col-xs-6 col-sm-4 col-xl-2 isotope-item oh-desktop">
            <!-- Thumbnail Mary-->
            <article class="thumbnail thumbnail-mary thumbnail-mary-2 wow slideInRight"><a class="thumbnail-mary-figure"
                href="images/gallery-6-1200x800-original.jpg" data-lightgallery="item"><img
                  src="images/carne.jpg" alt="" width="311" height="289" /></a>
              <div class="thumbnail-mary-caption">
                <div>
                  <h6 class="thumbnail-mary-title"><a href="#">CARNE DE RES A LA JARDINERA</a></h6>
                  <div class="thumbnail-mary-location">Recetas especiales</div>
                </div>
              </div>
            </article>
          </div>
          <div class="col-xs-6 col-sm-4 col-xl-2 isotope-item oh-desktop">
            <!-- Thumbnail Mary-->
            <article class="thumbnail thumbnail-mary thumbnail-mary-2 wow slideInLeft"><a class="thumbnail-mary-figure"
                href="images/gallery-7-1200x800-original.jpg" data-lightgallery="item"><img
                  src="images/fajitas(1).jpg" alt="" width="311" height="289" /></a>
              <div class="thumbnail-mary-caption">
                <div>
                  <h6 class="thumbnail-mary-title"><a href="#">FAJITAS DE CARNE DE RES</a></h6>
                  <div class="thumbnail-mary-location">Sabores</div>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>


    <!-- Section Services  Last section-->
    <section class="section section-sm bg-default">
      <div class="container">
        <div class="owl-carousel owl-style-11 dots-style-2" data-items="1" data-sm-items="1" data-lg-items="2"
          data-xl-items="4" data-margin="30" data-dots="true" data-mouse-drag="true" data-rtl="true">
          <article class="box-icon-megan wow fadeInUp">
            <div class="box-icon-megan-header">
              <div class="box-icon-megan-icon linearicons-bag"></div>
            </div>
            <h5 class="box-icon-megan-title"><a href="#">Entrega</a></h5>
            <p class="box-icon-megan-text">Si pides más de 3 kilos con gusto te los entregaremos gratis.
            </p>
          </article>
          <article class="box-icon-megan wow fadeInUp" data-wow-delay=".05s">
            <div class="box-icon-megan-header">
              <div class="box-icon-megan-icon linearicons-map2"></div>
            </div>
            <h5 class="box-icon-megan-title"><a href="#">Alcance</a></h5>
            <p class="box-icon-megan-text">El mercado objetivo abarca zonas de Kennedy,Bosa y Rafael Uribe Uribe</p>
          </article>
          <article class="box-icon-megan wow fadeInUp" data-wow-delay=".1s">
            <div class="box-icon-megan-header">
              <div class="box-icon-megan-icon linearicons-radar"></div>
            </div>
            <h5 class="box-icon-megan-title"><a href="#">Disponibilidad</a></h5>
            <p class="box-icon-megan-text">Puedes hacer reservas para tus pedidos las 24 horas del día, los 7 días de la semana</p>
          </article>
          <article class="box-icon-megan wow fadeInUp" data-wow-delay=".15s">
            <div class="box-icon-megan-header">
              <div class="box-icon-megan-icon linearicons-thumbs-up"></div>
            </div>
            <h5 class="box-icon-megan-title"><a href="#">Mejor Servicio</a></h5>
            <p class="box-icon-megan-text">El cliente es nuestra prioridad número uno ya que brindamos un servicio al cliente de primer nivel.</p>
          </article>
        </div>
      </div>
    </section>
    <!-- Page Footer-->
    <footer class="section footer-modern context-dark footer-modern-2">
      <div class="footer-modern-line">
        <div class="container">
          <div class="row row-50">
            <div class="col-md-6 col-lg-4">
              <h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft">PRODUCTOS</span></h5>
              <ul class="footer-modern-list d-inline-block d-sm-block wow fadeInUp">
                <li><a href="#">Cortes Premium</a></li>
                <li><a href="#">Cortes Estandar</a></li>
                <li><a href="#">Cortes Organicos</a></li>
                <li><a href="#">Cortes Magros</a></li>
              </ul>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft">NUESTRA EMPRESA</span>
              </h5>
              <ul class="footer-modern-list d-inline-block d-sm-block wow fadeInUp">
                <li><a href="about2.html">Sobre Nosotros</a></li>
                <li><a href="#">Aviso Legal</a></li>
                <li><a href="#">Terminos</a></li>
                <li><a href="#">Pago Seguro</a></li>
                <li><a href="contactanos2.html">Contactanos</a></li>
              </ul>
            </div>
            <div class="col-lg-4 col-xl-5">
              
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-modern-line-2">
        <div class="container">
          <div class="row row-30 align-items-center">
            <div class="col-sm-6 col-md-7 col-lg-4 col-xl-4">
              <div class="row row-30 align-items-center text-lg-center">
                <div class="col-md-7 col-xl-6"><a class="brand" href="index2.html"><img
                      src="logoC.png" alt="" width="198" height="66" /></a></div>
                <div class="col-md-5 col-xl-6">
                  <div class="iso-1"><span><img src="images/imagen11.png" alt="" width="58"
                        height="25" /></span><span class="iso-1-big">9.4k</span></div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-12 col-lg-8 col-xl-8 oh-desktop">
              <div class="group-xmd group-sm-justify">
                <div class="footer-modern-contacts wow slideInUp">
                  <div class="unit unit-spacing-sm align-items-center">
                    <div class="unit-left"><span class="icon icon-24 mdi mdi-phone"></span></div>
                    <div class="unit-body"><a class="phone" href="tel:#">+573182575587</a></div>
                  </div>
                </div>
                <div class="footer-modern-contacts wow slideInDown">
                  <div class="unit unit-spacing-sm align-items-center">
                    <div class="unit-left"><span class="icon mdi mdi-email"></span></div>
                    <div class="unit-body"><a class="mail" href="mailto:#">carnesbyr@gmail.com</a></div>
                  </div>
                </div>
                <div class="wow slideInRight">
                  <ul class="list-inline footer-social-list footer-social-list-2 footer-social-list-3">
                    <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                    <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                    <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                    <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-modern-line-3">
        <div class="container">
          <div class="row row-10 justify-content-between">
            <div class="col-md-6"><span>Calle 79b#70A-31<span></div>
            <div class="col-md-auto">
              <!-- Rights-->
              <p class="rights"><span>&copy;&nbsp;</span><span
                  class="copyright-year"></span><span></span><span>.&nbsp;</span><span>All Rights Reserved.</span><span>
                  Design&nbsp;by&nbsp;<a href="https://www.templatemonster.com">TemplateMonster</a></span></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!-- Global Mailform Output-->
  <div class="snackbars" id="form-output-global"></div>
  <!-- Javascript-->
  <script src="js/core.min.js"></script>
  <script src="js/script.js"></script>
  <!-- coded by Himic-->
</body>

</html>