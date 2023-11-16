<?php
if (!isset($_SESSION['id']) && $_SESSION['rol'] == 'admin') {
  echo "<script>alert('No tiene permisos para ver esta pagina');</script>";
  echo "<script>window.location.href='index.php?modulo=login';</script>";
  exit();
}

if (!isset($_GET['accion'])) {
  $_GET['accion'] = '';
}


if (isset($_POST['editar_nombre'])) {
  $nuevo_nombre = $_POST['nombre'];
  $id_usuario = $_POST['editar_nombre'];
  $sqlUsuario = "UPDATE usuarios SET nombre = '$nuevo_nombre', fecha_modificacion = NOW() WHERE id = '$id_usuario'";
  $sqlUsuario = mysqli_query($con, $sqlUsuario);
  echo mysqli_error($con);
  if (mysqli_error($con)) {
    echo "<script>alert('Hubo un error, no se pudo editar el nombre');</script>";
  } else {
    echo "<script>alert('Nombre Editado');</script>";
  }
}

if (isset($_POST['editar_email'])) {
  $nuevo_email = $_POST['email'];
  $id_usuario = $_POST['editar_email'];
  $sqlUsuario = "UPDATE usuarios SET email = '$nuevo_email', fecha_modificacion = NOW() WHERE id = '$id_usuario'";
  $sqlUsuario = mysqli_query($con, $sqlUsuario);
  if (mysqli_error($con)) {
    echo "<script>alert('Hubo un error, no se pudo editar la email');</script>";
  } else {
    echo "<script>alert('Email Editado');</script>";
  }
}

if (isset($_POST['eliminar_usuario'])) {
  $id_usuario = $_POST['eliminar_usuario'];
  $sqlUsuario = "DELETE FROM usuarios WHERE id = '$id_usuario'";
  if (mysqli_error($con)) {
    echo "<script>alert('Hubo un error, no se pudo eliminar el usuario');</script>";
  } else {
    echo "<script>alert('Usuario Eliminado');</script>";
  }
}
?>

<main class="flex items-center justify-center m-0 p-3 min-h-screen">
  <section class="flex items-center justify-center">
    <?php
    $id_usuario = $_SESSION['id'];
    $sqlUsuarios = "SELECT id, nombre, email, rol, fecha_creacion, fecha_modificacion FROM usuarios";
    $sqlUsuarios = mysqli_query($con, $sqlUsuarios);
    echo mysqli_error($con);
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
              Fecha de Registro
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
            <form method="post" action="index.php?modulo=modificar_usuarios">
              <tr class="bg-white border-b">
                <td scope="row" class="px-6 py-4">
                  <?php echo $r['id']; ?>
                </td>
                <td class="px-6 py-4 items-center">
                  <input class="text-center w-full" value="<?php echo $r['nombre']; ?>" name="nombre">
                </td>
                <td class="px-6 py-4">
                  <input class="text-center w-full" value="<?php echo $r['email']; ?>" name="email">
                </td>
                <td class="px-6 py-4">
                  <?php echo $r['rol']; ?>
                </td>
                <td class="px-6 py-4">
                  <?php echo $r['fecha_creacion']; ?>
                </td>
                <td class="px-6 py-4">
                  <?php echo $r['fecha_modificacion']; ?>
                </td>
                <td class="px-6 py-4">
                  <div>
                    <div class="mt-2">
                      <button class="w-full text-colo3 bg-color4 hover:bg-color3 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5" type="submit" name="editar_nombre" value="<?php echo $r['id']; ?>">Editar Nombre</button>
                    </div>
                    <div class="mt-2">
                      <button class="w-full text-colo3 bg-color4 hover:bg-color3 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5" type="submit" name="editar_email" value="<?php echo $r['id']; ?>">Editar Email</button>
                    </div>
                    <div class="mt-2">
                      <form method="post" action="index.php?modulo=carrito">
                        <button type="submit" class="w-full text-colo3 bg-color4 hover:bg-color3 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5" name="eliminar_usuario" value="<?php echo $r['id'] ?>">Eliminar</button>
                      </form>
                    </div>
                  </div>
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
