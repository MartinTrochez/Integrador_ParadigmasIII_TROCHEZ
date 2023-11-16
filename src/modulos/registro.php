<?php
if (isset($_POST['nombre']) && isset($_POST['email']) && $_POST['clave']) {
  $sql = "SELECT * FROM usuarios where nombre = '" . $_POST['nombre'] . "'";
  $sql = mysqli_query($con, $sql);
  if (mysqli_num_rows($sql) != 0) {
    echo "<script>alert('Error: el usuario ya existe en la BD.');</script>";
  } else {
    $sql = "INSERT INTO usuarios (nombre, clave) VALUES ('" . $_POST['nombre'] . "', '" . $_POST['clave'] . "')";
    $sql = mysqli_query($con, $sql);
    if (mysqli_error($con)) {
      echo "<script>alert('Error nose pudo insertar el registro');</script>";
    } else {
      echo "<script>alert('Registro insertado con exito');</script>";
    }
  }
  echo "<script>windows.location='index.php?modulo=login';";
}
?>

<section class="bg-gray-50">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 ">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-color3 md:text-2xl ">
          Ingresa con tu cuenta
        </h1>
        <form class="space-y-4 md:space-y-6" action="index.php?modulo=login" method="POST">
          <div>
            <label for="name" class="block mb-2 text-sm font-medium text-color5">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Ingrese su nombre" required>
          </div>
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-color5">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required>
          </div>
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
            <input type="password" name="clave" id="clave" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " required=>
          </div>
          <?php
          if (!empty($_SESSION['nombre_usuario'])) {
          ?>
            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cerrar Sesión</button>
          <?php
          } else {
          ?>
            <button type="submit" class="w-full text-colo3 bg-color4 hover:bg-color3 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center">Registrarse</button>
          <?php
          }
          ?>
        </form>
      </div>
    </div>
  </div>
</section>
