<?php
session_start();
include './src/includes/conexion.php';
conectar();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./src/css/listado_productos_box.css" />
  <link rel="stylesheet" href="./src/css/producto.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./dist/output.css" />
  <script src="./src/scripts/menuMobil.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Trabajo Integrador - TROCHEZ, MARTIN EMILIANO</title>
</head>

<body class="bg-background z-0 m-0 p-0 font-sans">

  <!-- Header Navbar -->
  <header class="bg-color1 w-full m-0">
    <h1 class="m-0 place-content-center w-full flex">
      <img class="m-0 inline-block self-center" src="./src/imagenes/logo.png" width="140" alt="e-commerce" />
    </h1>
    <nav class="pt-0 pb-1 mt-0 w-full bg-color1 items-center inline-flex justify-between shadow-[0_-12px_-15px_21px_#832424] h-1/6 flex-wrap">
      <div>
        <div class="block md:hidden mr-auto ml-3 my-auto cursor-pointer">
          <div id="menu-mobil" class="group peer">
            <div class="top-0 group-open:rotate-45 group-open:top-2 relative transition-all bg-color6 rounded-full w-8 h-1"></div>
            <div class="opacity-100 group-open:opacity-0 transition-all bg-color6 rounded-full w-8 h-1 mt-1"></div>
            <div class="top-0 group-open:-rotate-45 group-open:-top-2 relative transition-all bg-color6 rounded-full w-8 h-1 mt-1"></div>
          </div>
          <div class="absolute hidden peer-open:block top-[5.3rem] w-full bg-color1 right-0">
            <div class="relative flex h-full cursor-pointer items-center">
              <a class="mx-auto my-auto text-color6 hover:text-color3" href="index.php">Inicio</a>
            </div>
            <div class="relative flex h-full cursor-pointer items-center">
              <a class="mx-auto my-auto text-color6 hover:text-color3" href="index.php?modulo=listado_producto_tabla">Listado Productos Tabla</a>
            </div>
            <div class="relative flex h-full cursor-pointer items-center">
              <a class="mx-auto my-auto text-color6 hover:text-color3" href="index.php?modulo=listado_producto_box">Listado Productos Box</a>
            </div>
            <div class="relative flex h-full cursor-pointer items-center">
              <a class="mx-auto my-auto text-color6 hover:text-color3" href="index.php?modulo=carrito_historial">Historial de Compras</a>
            </div>
            <div class="relative flex h-full cursor-pointer items-center">
              <a class="mx-auto my-auto text-color6 hover:text-color3" href="index.php?modulo=cantidad_tipos_pagos_realizados">Detalles Tipos Pagos</a>
            </div>
          </div>
        </div>
        <ul class="md:inline-flex hidden list-none justify-evenly">
          <li class="pr-3 ml-2 border-r-2 border-solid border-color6">
            <a class="text-color6 hover:text-color3" href="index.php">Inicio</a>
          </li>
          <li class="pr-3 ml-3 border-r-2 border-solid border-color6">
            <a class="text-color6 hover:text-color3" href="index.php?modulo=listado_producto_tabla">Listado Producto
              Tabla</a>
          </li>
          <li class="pr-3 ml-3 border-r-2 border-solid border-color6">
            <a class="text-color6 hover:text-color3" href="index.php?modulo=listado_producto_box">Listado Producto Box</a>
          </li>
          <?php
          if (isset($_SESSION['id'])) {
            if ($_SESSION['rol'] == 'admin') {
          ?>
              <li class="pr-3 ml-3 border-r-2 border-solid border-color6">
              <?php
            } else {
              ?>
              <li class="ml-3">
              <?php
            }
              ?>
              <a class="text-color6 hover:text-color3" href="index.php?modulo=carrito_historial">Historial de Compras</a>
              </li>
            <?php
          }
            ?>
            <?php
            if (isset($_SESSION['id'])) {
              if ($_SESSION['rol'] == 'admin') {
            ?>
                <li class="pr-3 ml-3 border-r-2 border-solid border-color6">
                  <a class="mx-auto my-auto text-color6 hover:text-color3" href="index.php?modulo=modificar_usuarios">Modificar Usuarios</a>
                </li>
                <li class="pr-3 ml-3 border-r-2 border-solid border-color6">
                  <a class="text-color6 hover:text-color3" href="index.php?modulo=historial_cambios_usuarios">Historial de Usuarios</a>
                </li>
                <li class="pr-3 ml-3 border-r-2 border-solid border-color6">
                  <a class="text-color6 hover:text-color3" href="index.php?modulo=ventas_acumuladas">Ventas Acumuladas</a>
                </li>
                <li class="ml-3">
                  <a class="text-color6 hover:text-color3" href="index.php?modulo=cantidad_tipos_pagos_realizados">Cantidad Tipos Pagos</a>
                </li>
            <?php
              }
            }
            ?>
        </ul>
      </div>
      <div class="mr-1">
        <ul class="list-none inline-flex">
          <li class="pr-3 border-r-2 border-solid border-color6">
            <a class="text-color6 hover:text-color3 active:text-color7 active:font-bold" href="index.php?modulo=carrito">
              <span class="material-symbols-outlined">
                shopping_cart
              </span>
            </a>
          </li>
          <li class="ml-3 mr-2">
            <a class="text-color6  active:text-color7 active:font-bold" href="index.php?modulo=login">
              <span class="material-symbols-outlined">
                account_circle
              </span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>


  <?php
  // main section
  if (!empty($_GET['modulo'])) {
    include('./src/modulos/' . $_GET['modulo'] . '.php');
  } else {
  ?>
    <p>asdasd</p>
  <?php
  }
  ?>

  <footer class="w-full bg-color1 inline-flex">
    <small class="mx-auto my-auto text-color7 font-semibold">
      2023 - E-Commerce - Codigo Fuente:
      <a class="text-color6 hover:text-color3 active:text-color7 active:font-bold" href="#"><i class="fa">&#xf09b;</i></a>
    </small>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      autoplay: true,
      autoplayTimeout: 2000,
      center: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    })
  </script>
</body>

</html>
