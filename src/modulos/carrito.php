<?php
if (!isset($_SESSION['id'])) {
  echo "<script>alert('Debe iniciar sesión para ver el carrito');</script>";
  echo "<script>window.location.href='index.php?modulo=login';</script>";
  exit();
}
if (!isset($_GET['accion'])) {
  $_GET['accion'] = '';
}

if (isset($_POST['editar_cantidad'])) {
  $nueva_cantidad = $_POST['cantidad'];
  $id_carrito = $_POST['editar_cantidad'];
  $sqlEditarCantidad = "UPDATE productos_carrito SET cantidad = '$nueva_cantidad', fecha_modificacion = NOW() WHERE id = '$id_carrito'";
  $sqlEditarCantidad = mysqli_query($con, $sqlEditarCantidad);
  if (mysqli_error($con)) {
    echo "<script>alert('Hubo un error, no se pudo editar la cantidad');</script>";
  } else {
    echo "<script>alert('Cantidad Editada');</script>";
  }
}

if (isset($_POST['eliminar_producto'])) {
  $id_usuario = $_SESSION['id'];
  $id_producto = $_POST['eliminar_producto'];
  $sqlEliminarProducto = "DELETE FROM productos_carrito WHERE id_usuarios = '$id_usuario' and id_producto = '$id_producto' and estado_compra = 'no finalizado'";
  $sqlEliminarProducto = mysqli_query($con, $sqlEliminarProducto);
  if (mysqli_error($con)) {
    echo "<script>alert('Hubo un error, no se pudo eliminar el producto');</script>";
  } else {
    echo "<script>alert('Producto Eliminado');</script>";
  }
}

?>

<main class="flex items-center justify-center m-0 p-3 min-h-screen">
  <section class="flex items-center justify-center">
    <?php
    $totalCompras = 0;
    $id_usuario = $_SESSION['id'];
    $sqlProductos = "SELECT c.id, c.id_producto, c.cantidad, p.nombre, p.precio FROM productos_carrito c INNER JOIN productos p ON c.id_producto = p.id INNER JOIN usuarios u on c.id_usuarios = u.id WHERE  p.estado = 'disponible' AND c.estado_compra = 'no finalizado' and c.id_usuarios = '$id_usuario'";
    $sqlProductos = mysqli_query($con, $sqlProductos);
    if (mysqli_num_rows($sqlProductos) == 0) {
    ?>
      <h3>Carrito Vacío</h3>
    <?php
    } else {
    ?>
      <table class="text-sm text-left text-gray-500 dark:text-gray-400 overflow-x-auto w-5/6">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b">
          <tr>
            <th scope="col" class="px-6 py-3">
              Guitarra
            </th>
            <th scope="col" class="px-6 py-3">
              Nombre
            </th>
            <th scope="col" class="px-6 py-3">
              Cantidad
            </th>
            <th scope="col" class="px-6 py-3">
              Precio por unidad
            </th>
            <th>
              Subtotal
            </th>
            <th scope="col" class="px-6 py-3">
              Acciones
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($r = mysqli_fetch_array($sqlProductos)) {
            $subTotal = $r['cantidad'] * $r['precio'];
            $totalCompras = $subTotal + $totalCompras;
          ?>

            <form method="post" action="index.php?modulo=carrito">
              <tr class="bg-white border-b">
                <td scope="row" class="text-gray-900 hover:bg-color3">
                  <a class="flex items-center justify-center" href="index.php?modulo=producto&id=<?php echo $r['id_producto'] ?>">
                    <img class="w-14" src="./src/imagenes/guitarra<?php echo $r['id_producto']; ?>" alt="Ver ficha de la guitarra">
                  </a>
                </td>
                <td class="px-6 py-4">
                  <?php echo $r['nombre']; ?>
                </td>
                <td class="px-6 py-4">
                  <input class="text-center w-1/2" value="<?php echo $r['cantidad']; ?>" name="cantidad">
                </td>
                <td class="px-6 py-4">
                  <?php echo $r['precio']; ?>
                </td>
                <td class="px-6 py-4">
                  <?php echo $subTotal . "$"; ?>
                </td>
                <td class="px-6 py-4">
                  <div>
                    <div class="mt-2">
                      <button class="w-full text-colo3 bg-color4 hover:bg-color3 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5" type="submit" name="editar_cantidad" value="<?php echo $r['id']; ?>">Editar Cantidad</button>
                    </div>
                    <div class="mt-2">
                      <form method="post" action="index.php?modulo=carrito">
                        <button type="submit" class="w-full text-colo3 bg-color4 hover:bg-color3 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5" name="eliminar_producto" value="<?php echo $r['id_producto'] ?>">Eliminar</button>
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
            </form>
          <?php
          }
          ?>
          <tr>
            <th scope="col" class="px-6 py-3">
              Total
            </th>
            <th scope="col" class="px-6 py-3">
            </th>
            <th scope="col" class="px-6 py-3">
            </th>
            <th scope="col" class="px-6 py-3">
            </th>
            <th scope="col" class="px-6 py-3">
              <?php echo $totalCompras . "$"; ?>
            </th>
          </tr>
        </tbody>
      </table>
      <p class="text-sm font-bold text-color7 end-0">
        <a class="flex items-center justify-center" href="index.php?modulo=formulario&id=<?php $_SESSION['id']; ?>&formulario=ir_formulario&total_compras=<?php echo $totalCompras ?>" class="mx-auto my-auto text-color4 hover:text-color7">Continuar</a>
      </p>
    <?php
    }
    ?>
  </section>
</main>
