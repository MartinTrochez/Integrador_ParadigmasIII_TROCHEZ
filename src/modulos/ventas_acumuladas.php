<?php
if (!isset($_SESSION['id']) && $_SESSION['rol'] == 'admin') {
  echo "<script>alert('No tiene permisos para ver esta pagina');</script>";
  echo "<script>window.location.href='index.php?modulo=login';</script>";
  exit();
}

if (!isset($_GET['accion'])) {
  $_GET['accion'] = '';
}


?>

<main class="flex items-center justify-center m-0 p-3 min-h-screen">
  <section class="flex items-center justify-center">
    <?php
    $id_usuario = $_SESSION['id'];
    $sqlVentasAcumuladas = "CALL P_sumas_acumuladas()";
    $sqlVentasAcumuladas = $con->query($sqlVentasAcumuladas);
    echo mysqli_error($con);
    if (mysqli_num_rows($sqlVentasAcumuladas) == 0) {
    ?>
      <h3>No existen Ventas</h3>
    <?php
    } else {
    ?>
      <table class="text-sm text-left text-gray-500 overflow-x-auto w-5/6 rounded-lg shadow">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
          <tr>
            <th scope="col" class="px-6 py-3">
              Id
            </th>
            <th scope="col" class="px-6 py-3">
              Nombre
            </th>
            <th scope="col" class="px-6 py-3">
              Fecha Compra
            </th>
            <th scope="col" class="px-6 py-3">
              Total
            </th>
            <th scope="col" class="px-6 py-3">
              Total Acumulado
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          do {
            if ($sqlVentasAcumuladas = $con->store_result()) {
              while ($r = $sqlVentasAcumuladas->fetch_assoc()) {
          ?>
                <tr class="bg-white border-b">
                  <td scope="row" class="px-6 py-4">
                    <?php echo $r['id']; ?>
                  </td>
                  <td class="px-6 py-4 items-center">
                    <?php echo $r['nombre']; ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo $r['fecha_creacion']; ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo $r['total_compras']; ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo $r['ventas_acumuladas']; ?>
                  </td>
                </tr>
          <?php
              }
              $sqlVentasAcumuladas->free();
            }
          } while ($con->more_results() && $con->next_result());
          ?>
        </tbody>
      </table>
    <?php
    }
    ?>
  </section>
</main>
