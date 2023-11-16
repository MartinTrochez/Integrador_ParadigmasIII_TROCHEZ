<?php
$sqlProductos = "SELECT * FROM productos WHERE estado = 'disponible'";
$sqlProductos = mysqli_query($con, $sqlProductos);
?>
<main class="flex items-center justify-center m-0 p-3 min-h-screen">
  <section class="flex items-center justify-center">
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
            Descripción
          </th>
          <th scope="col" class="px-6 py-3">
            Precio
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (mysqli_num_rows($sqlProductos) != 0) {
          while ($r = mysqli_fetch_array($sqlProductos)) {
        ?>
            <tr class="bg-white border-b">
              <th scope="row" class="text-gray-900 hover:bg-color3">
                <a class="flex items-center justify-center" href="index.php?modulo=producto&id=<?php echo $r['id'] ?>">
                  <img class="w-14" src="./src/imagenes/guitarra<?php echo $r['id']; ?>" alt="Ver ficha de la guitarra">
                </a>
              </th>
              <td class="px-6 py-4">
                <?php echo $r['nombre']; ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['descripcion']; ?>
              </td>
              <td class="px-6 py-4">
                <?php echo $r['precio']; ?>
              </td>
            </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
  </section>
</main>
