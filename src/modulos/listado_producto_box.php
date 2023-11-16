<?php
$sqlProductos = "SELECT * FROM productos WHERE estado = 'disponible'";
$sqlProductos = mysqli_query($con, $sqlProductos);
?>

<main class="flex items-center justify-center m-0 p-3 min-h-screen">
  <section class="listado-producto-box basis-1/2">
    <h2 class="bg-color3 text-center mb-0 text-color7 font-bold">Listado de producto</h2>
    <section class="contenido-box-section">
      <?php
      if (mysqli_num_rows($sqlProductos) != 0) {
        while ($r = mysqli_fetch_array($sqlProductos)) {
      ?>
          <div class="contenido-box">
            <div class="nombre-guitarra">
              <h5><?php echo $r['nombre']; ?></h5>
            </div>
            <div class="detalle-guitarra">
              <a href="index.php?modulo=producto&id=<?php echo $r['id'] ?>">
                <img src="./src/imagenes/guitarra<?php echo $r['id']; ?>" title="Ver ficha del guitarr" alt="Ver ficha de la guitarra">
              </a>
              <div class="precio-producto">
                <ul>
                  <li class="precio-del-producto">
                    <p>Precio: <?php echo $r['precio']; ?></p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </section>
  </section>
</main>
