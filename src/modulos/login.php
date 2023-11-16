<?php
// Login
if (isset($_GET['salir'])) {
  session_destroy();
  echo "<script>window.location='index.php?modulo=login';</script>";
}

if (empty($_SESSION['nombre_usuario']) == false) {
?>
  <section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 w-2/5">
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-color3 md:text-2xl ">
            Bienvenido: <?php echo $_SESSION['nombre_usuario']; ?>
          </h1>
          <a href="index.php?modulo=login&salir=ok">Salir</a>
        </div>
      </div>
    </div>
  </section>
<?php
} else {
  if (isset($_POST['email']) && isset($_POST['clave'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $clave = mysqli_real_escape_string($con, $_POST['clave']);
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND clave = '$clave'";
    $r = mysqli_query($con, $sql);

    if (mysqli_num_rows($r) != 0) {
      $r = mysqli_fetch_array($r);
      $_SESSION['id'] = $r['id'];
      $_SESSION['nombre_usuario'] = $r['nombre'];
      $_SESSION['rol'] = $r['rol'];
      echo "<script>alert('Bienvenido: " . $_SESSION['nombre_usuario'] . "');</script>";
      echo "<script>window.location='index.php';</script>";
      exit;
    } else {
      echo "<script>alert('Verificar los datos.');</script>";
    }
  }
?>
  <section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 w-2/5">
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-color3 md:text-2xl ">
            Ingresa con tu cuenta
          </h1>
          <form class="space-y-4 md:space-y-6" action="index.php?modulo=login" method="POST">
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-color5">Email</label>
              <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="" required>
            </div>
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
              <input type="password" name="clave" id="clave" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " required>
            </div>
            <button type="submit" class="w-full text-colo3 bg-color4 hover:bg-color3 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center">Ingresar</button>
            <!-- Redireccionar to registro.php -->
            <p class="text-sm font-bold text-color7">
              No tienes una cuenta? <a href="index.php?modulo=registro" class="mx-auto my-auto text-color4 hover:text-color7">Registrarse</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php
}
?>
