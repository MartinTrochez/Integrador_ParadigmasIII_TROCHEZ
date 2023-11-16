<?php

if (!isset($_SESSION['id'])) {
  echo "<script>alert('Debe iniciar sesión para finalizar la compra');</script>";
  echo "<script>window.location.href='index.php?modulo=login';</script>";
  exit();
}

if (!isset($_GET['accion'])) {
  $_GET['accion'] = '';
}

if ($_GET['accion'] == 'finalizar_compra') {
  $id_usuario = $_SESSION['id'];
  $direccion = $_POST['direccion'];
  $telefono = $_POST['telefono'];
  $metodo_pago = $_POST['metodo_pago'];
  echo $metodo_pago;
  $numero_tarjeta = $_POST['numero_tarjeta'];
  $total = $_POST['total_compras'];
  $sqlFinalizarCompra = "INSERT INTO carritos (id_usuarios, metodo_pago, numero_tarjeta, direccion, telefono, total_compras, fecha_creacion) VALUES ('$id_usuario', '$metodo_pago', '$numero_tarjeta' ,'$direccion', '$telefono', '$total', NOW())";
  $sqlFinalizarCompra = mysqli_query($con, $sqlFinalizarCompra);
  $sqlIdProdcutosCarrito = "SELECT id FROM productos_carrito WHERE id_usuarios = '$id_usuario' and estado_compra = 'no finalizado'";
  $sqlIdProdcutosCarrito = mysqli_query($con, $sqlIdProdcutosCarrito);
  $r = mysqli_fetch_array($sqlIdProdcutosCarrito);
  $id_producto_carrito = $r['id'];
  echo mysqli_error($con);
  if (mysqli_error($con)) {
    echo "<script>alert('Hubo un error, no se pudo finalizar la compra');</script>";
  } else {
    $sqlCambiarEstadoProCarri = "UPDATE productos_carrito SET estado_compra = 'finalizado' WHERE id = '$id_producto_carrito'";
    $sqlCambiarEstadoProCarri = mysqli_query($con, $sqlCambiarEstadoProCarri);
    echo "<script>alert('Compra Finalizada');</script>";
    echo "<script>window.location.href='index.php';</script>";
  }
}
?>
<main class="flex items-center justify-center m-0 p-3 min-h-screen">
  <section class="main-section flex justify-center">
    <div>
      <form class="formulario-compra w-full text-center" action="index.php?modulo=formulario&accion=finalizar_compra" method="POST">
        <h2 class="text-3xl font-semibold mb-8">Ingrese sus datos</h2>
        <div class="flex flex-col items-center">
          <label for="direccion" class="text-lg">Dirección</label>
          <input class="input w-full p-3 m-2 border border-gray-300 rounded-md text-center" type="text" name="direccion" value="direccion" required>
        </div>
        <div class="flex flex-col items-center">
          <label for="telefono" class="text-lg">Teléfono de contacto</label>
          <input class="input w-full p-3 m-2 border border-gray-300 rounded-md text-center" type="tel" name="telefono" value="telefono" required>
        </div>
        <div class="contenedor-medio-de-pago-flex flex sm:flex-row flex-wrap flex-column">
          <div class="tipo-tarjeta sm:w-1/2 w-full">
            <label for="metodo_pago" class="text-lg">Medio de pago</label>
            <select name="metodo_pago" required class="w-full p-3 m-2 border border-gray-300 rounded-md text-center">
              <option value="">Selecione un metodo de pago</option>
              <option value="debito">Debito</option>
              <option value="credito">Credito</option>
            </select>
          </div>
          <div class="datos-tarjeta sm:w-1/2 w-full">
            <label for="" class="text-lg">Numero de la Tarjeta</label>
            <input type="number" name="numero_tarjeta" value="numero_tarjeta" required class="w-full p-3 m-2 border border-gray-300 rounded-md text-center">
          </div>
        </div>
        <div class="flex flex-col items-center">
          <label for="total" class="text-lg">Total</label>
          <input class="input w-full p-3 m-2 border border-gray-300 rounded-md text-center" type="number" name="total_compras" value="<?php echo  htmlspecialchars($_GET['total_compras']) ?>" readonly>
        </div>
        <input type="submit" name="comprar" value="comprar" class=" hover:bg-color1 bg-color4 text-lg text-white text-color7 font-bold border-none w-1/2 rounded">
      </form>
    </div>
  </section>
</main>
