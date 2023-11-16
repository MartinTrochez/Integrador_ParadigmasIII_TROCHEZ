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
    $sqlProductos = "SELECT c.id, c.id_producto, c.cantidad, p.nombre, p.precio FROM productos_carrito c INNER JOIN productos p ON c.id_producto = p.id INNER JOIN usuarios u on c.id_usuarios = u.id WHERE  p.estado = 'disponible' AND c.estado_compra = 'finalizado' and c.id_usuarios = '$id_usuario'";
    $sqlProductos = mysqli_query($con, $sqlProductos);
    if (mysqli_num_rows($sqlProductos) == 0) {
    ?>
      <h3>No realizo compras en la tienda</h3>
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
          </tr>
        </thead>
        <tbody>
          <?php
          while ($r = mysqli_fetch_array($sqlProductos)) {
            $subTotal = $r['cantidad'] * $r['precio'];
            $totalCompras = $subTotal + $totalCompras;
          ?>
            <tr class="bg-white border-b">
              <td scope="row" class="px-6 py-4">
                <a class="flex items-center justify-center" href="index.php?modulo=producto&id=<?php echo $r['id_producto'] ?>">
                  <img class="w-14" src="./src/imagenes/guitarra<?php echo $r['id_producto']; ?>" alt="Ver ficha de la guitarra">
                </a>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['nombre']; ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['cantidad']; ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['precio']; ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['cantidad'] ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $subTotal . "$"; ?>
              </td>
            </tr>
            </form>
          <?php
          }
          ?>
          <tr>
            <th scope="col" class="px-6 py-3">
              Total Compras Hechas
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
    <?php
    }
    ?>
  </section>
</main>
