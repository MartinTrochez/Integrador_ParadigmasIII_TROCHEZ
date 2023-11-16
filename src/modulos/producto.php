<?php
if (!isset($_GET['id'])) {
  header('Location: index.php');
  exit();
} else {
  $maximaCantidadProcutos = "SELECT cantidad_inventario FROM productos WHERE id = " . $_GET['id'];
  $maximaCantidadProcutos = mysqli_query($con, $maximaCantidadProcutos);
  // echo mysqli_error($con);
  $r = mysqli_fetch_array($maximaCantidadProcutos);
  $maximaCantidadProcutos = $r['cantidad_inventario'];
}

if (!isset($_GET['accion'])) {
  $_GET['accion'] = '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cantidad']) && $_POST['accion'] == 'agregar') {
  $id_usuario = $_SESSION['id'];
  $id_producto = $_GET['id'];
  $cantidad = $_POST['cantidad'];
  if ($cantidad > $maximaCantidadProcutos) {
    echo "<script> alert('No hay suficientes guitarras en stock');</script>";
    exit();
  }
  $sqlPrecio = "SELECT precio FROM productos WHERE id = " . $_GET['id'];
  $sqlPrecio = mysqli_query($con, $sqlPrecio);
  $r = mysqli_fetch_array($sqlPrecio);
  $precio = $r['precio'];
  $sqlProductosCarrito = "SELECT id, cantidad FROM productos_carrito WHERE id_usuarios = '$id_usuario' and id_producto = '$id_producto' and estado_compra = 'no finalizado'";
  $sqlProductosCarrito = mysqli_query($con, $sqlProductosCarrito);
  echo mysqli_error($con);
  if (mysqli_num_rows($sqlProductosCarrito) == 0) {
    $sqlInsertarProducto = "INSERT INTO productos_carrito (id_usuarios, id_producto, cantidad, fecha_creacion, subtotal) VALUES ($id_usuario, $id_producto, $cantidad, NOW(), '$precio')";
    $sqlInsertarProducto = mysqli_query($con, $sqlInsertarProducto);
    if (mysqli_error($con)) {
      echo "<script> alert('Error en la carga de la guitarra en el carrito - Cantidad: $cantidad - Usuario: $id_usuario - Producto: $id_producto);</script>";
      exit();
    }
    echo "<script> alert('Guitarra cargada en el carrito');</script>";
  } else {
    $sqlInsertarProducto = "UPDATE productos_carrito SET cantidad = $cantidad, fecha_modificacion = NOW() WHERE id_usuarios = '$id_usuario' and id_producto = '$id_producto'";
    $sqlInsertarProducto = mysqli_query($con, $sqlInsertarProducto);
    echo $sqlInsertarProducto;
  }
  $maximaCantidadProcutos = $maximaCantidadProcutos - $cantidad;
  $maximaCantidadProcutos = "UPDATE productos SET cantidad_inventario = $maximaCantidadProcutos WHERE id = " . $_GET['id'];
  $maximaCantidadProcutos = mysqli_query($con, $maximaCantidadProcutos);
}

?>
<main class="mt-3 mb-3 min-h-screen">
  <section class="listado-producto-tabla">
    <section class="contenedor-tabla-section w-6/12">
      <div class="contenedor-tabla">
        <table class="tabla-producto">
          <tr class="titulo-columnas">
            <th>Guitarra</th>
            <th>Descripcion</th>
          </tr>
          <tr class="contenido-tabla">
            <?php
            $sqlProducto = "SELECT * FROM productos WHERE id = " . $_GET['id'];
            $sqlProducto = mysqli_query($con, $sqlProducto);
            if (mysqli_num_rows($sqlProducto) != 0) {
              while ($r = mysqli_fetch_array($sqlProducto)) {
            ?>
                <td class="w-1/2">
                  <div class="nombre-guitarra text-lg">
                    <h5><?php echo $r['nombre'] ?></h5>
                  </div>
                  <img src="./src/imagenes/guitarra<?php echo $r['id']; ?>" alt="guitarra">
                </td>
                <td class="w-1/2">
                  <p>
                    <?php echo $r['descripcion'] ?>
                  </p>
                  <ul class="mt-4">
                    <li>Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint
                      consectetur
                      cupidatat.</li>
                    <li>Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint
                      consectetur
                      cupidatat.</li>
                    <li>Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint
                      consectetur
                      cupidatat.</li>
                    <li>Lorem psum dolor sit amet, qui minim labore adipisicing minim sint cillum sint
                      consectetur
                      cupidatat.</li>
                    <li class="mt-3 mb-3">Precio: <?php $r['precio'] ?></li>
                    <li>
                      <?php
                      if (!empty($_SESSION['nombre_usuario'])) {
                      ?>
                        <form class="formulario-compra w-full text-center" action="index.php?&modulo=producto&id=<?php echo $r['id'] ?>&accion=agregar" method="POST">
                          <div class="contenedor-cantidad-producto sm:w-1/2 w-full">
                            <label for="cantidad" class="text-lg">Cantidad</label>
                            <input type="hidden" name="accion" value="agregar">
                            <input type="number" name="cantidad" value="cantidad" min="1" required class="w-full p-3 m-2 border border-gray-300 rounded-md text-center">
                            <input type="submit" value="Agregar" class="hover:bg-color1 bg-color4 text-lg text-white text-color7 font-bold border-none w-1/2 rounded">
                          </div>
                        </form>
                      <?php
                      }
                      ?>
                    </li>
                  </ul>
                </td>
            <?php
              }
            }
            ?>
          </tr>
        </table>
      </div>
    </section>
  </section>
</main>
