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
    $sqlUsuarios = "SELECT u.id, u.nombre, u.rol, u.email, l.razon, l.fecha_modificado FROM usuarios u INNER JOIN log_usuarios_modificado l on u.id = l.id_usuario";
    $sqlUsuarios = mysqli_query($con, $sqlUsuarios);
    if (mysqli_num_rows($sqlUsuarios) == 0) {
    ?>
      <h3>No existen Usuarios</h3>
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
              Email
            </th>
            <th scope="col" class="px-6 py-3">
              Rol
            </th>
            <th scope="col" class="px-6 py-3">
              Fecha de Ultima modificacion
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($r = mysqli_fetch_array($sqlUsuarios)) {
          ?>
            <tr class="bg-white border-b">
              <td scope="row" class="px-6 py-4">
                <?php echo $r['id']; ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['nombre']; ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['email']; ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['rol']; ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['fecha_modificado']; ?>
              </td>
            </tr>
            </form>
          <?php
          }
          ?>
        </tbody>
      </table>
    <?php
    }
    ?>
  </section>
</main>
