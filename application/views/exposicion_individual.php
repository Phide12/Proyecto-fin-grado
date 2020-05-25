<main>
  <?php if (isset($portada)) : ?>
    <div class="fullPage-block fondo-portada" style="background-image: url(<?= base_url() . $portada; ?>)">
    </div>
  <?php endif; ?>

  </div>
  <div class="container">
    <div class="contenedor-secundario bg-white">
      <a href="<?= base_url() . 'index.php/exposicion/vista_general'; ?>">
        <h3>Volver</h3>
      </a>
    </div>

    <div class="contenedor-secundario bg-white">
      <div class="panel_informacion">
        <div>
          <h1><?= $titulo; ?></h1><br>
          <h3><?= $autor; ?></h3>
        </div>

        <?php if (isset($_SESSION['id'])) : ?>
          <form name="cambiarFav" action="<?= base_url() . 'index.php/exposicion/switch_favoritos'; ?>" method="post">
            <input type="hidden" name="id_usuario" value="<?= $_SESSION['id']; ?>">
            <input type="hidden" name="id_exposicion" value="<?= $_GET['id']; ?>">
            <?php
            if (isset($estadoFavoritos)) {
              if ($estadoFavoritos) {
                echo '<input type="submit" value="quitar favoritos" style="display:none">';
                echo '<a class="icono_fav_off item-bt" onclick="document.cambiarFav.submit()"></a>';
              } else {
                echo '<input type="submit" value="insertar favoritos" style="display:none">';
                echo '<a class="icono_fav_on item-bt" onclick="document.cambiarFav.submit()"></a>';
              } ?>
            <?php
            }
            ?>
          </form>

        <?php endif; ?>
      </div>
    </div>

    <!-- INFORMACION -->
    <div class="contenedor-secundario bg-white">
      <div class="panel_informacion">
        <p>N. Visitas: <b><?= $num_visitas; ?></b></p>
        <p>Val. Media: <b><?= $val_media; ?></b></p>
      </div>
    </div>

    <!-- PORTADA -->
    <div class="contenedor-secundario bg-white">
      <img class="imagen_portada" src="<?= base_url() . $portada; ?>" /><br>
    </div>

    <!-- DESCRIPCION -->
    <div class="contenedor-secundario bg-white">
      <p><?= $descripcion; ?></p>
    </div>

    <!-- CONTENIDOS -->
    <?php
    if (isset($listaContenidos) && count($listaContenidos) > 0) : ?>
      <div class="contenedor-secundario bg-white ">
        <h3> Contenido </h3>
      </div>
      <div class="contenedor-secundario contenedor-rejilla" id="lista_contenido">
        <script>
          let listaContenidos = <?= json_encode($listaContenidos); ?>;

          for (let i = 0; i < listaContenidos.length; i++) {
            /* imagen */
            let imagenContenido = new Image();
            imagenContenido.src = '<?= base_url(); ?>' + listaContenidos[i].ubicacion;
            let dimensionMaxima = 400;
            if (imagenContenido.width > dimensionMaxima || imagenContenido.height > dimensionMaxima) {
              if (imagenContenido.width > imagenContenido.height) {
                let escalado = imagenContenido.width / dimensionMaxima;
                imagenContenido.width = dimensionMaxima;
                imagenContenido.height /= escalado;
              } else {
                let escalado = (imagenContenido.height / dimensionMaxima);
                imagenContenido.height = dimensionMaxima;
                imagenContenido.width /= escalado;
              }
            }
            /* texto */
            let textoContenido = document.createElement('div');
            textoContenido.className = 'texto_tarjeta_exposicion'
            textoContenido.innerHTML = listaContenidos[i].comentario;

            tarjetaExposicion = document.createElement('div');
            tarjetaExposicion.className = 'exposicion_tarjeta';
            tarjetaExposicion.appendChild(textoContenido);
            tarjetaExposicion.appendChild(imagenContenido);

            <?php if (isset($_SESSION['es_Admin'])) : ?>
              let formularioEliminar = document.createElement('form');
              formularioEliminar.action = '<?= base_url() . 'index.php/exposicion/eliminar_contenido'; ?>';
              formularioEliminar.method = 'post';
              formularioEliminar.innerHTML = '<input type="hidden" name="id_contenido" value="' + listaContenidos[i].id + '">' +
                '<input type="hidden" name="id_exposicion" value="<?= $_GET['id']; ?>">' +
                '<input type="hidden" name="ubicacion" value="' + listaContenidos[i].ubicacion + '">' +
                '<input type="submit" value="Eliminar" style="background-color:#ffffff">';
              tarjetaExposicion.appendChild(formularioEliminar);
            <?php endif; ?>
            document.getElementById('lista_contenido').appendChild(tarjetaExposicion);
          }
        </script>

      </div>
    <?php endif; ?>


    <?php if (isset($_SESSION['es_Admin'])) : ?>
      <!-- AÑADIR CONTENIDOS -->
      <div class="contenedor-secundario bg-white">
        <div class="formulario">
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_exposicion" value="<?= $id; ?>">
            <label for="contenido">Subir contenido de la exposición <span class="requerido">*</span> (3mb max - solo imágenes: png, jpg y jpeg)</label>
            <input type="file" name="contenido" required><br><br>
            <label for="comentario">Comentario del archivo subido <span class="requerido">*</span>(300 letras max)</label>
            <textarea name="comentario" maxlength="300" placeholder="texto/descripcion que acompañara al archivo multimedia en la exposicion..."></textarea><br>
            <input type="submit" name="subir" value="Subir" formaction="<?= base_url() . 'index.php/exposicion/subir_contenido_exposicion'; ?>">
          </form>
        </div>
      </div>
    <?php endif; ?>

    <!-- VALORACIONES -->
    <?php if (isset($_SESSION['nick'])) { ?>
      <!-- CREAR VALORACION -->
      <div class="contenedor-secundario bg-white">
        <h3>Crear valoración anónima</h3>
        <div class="formulario">
          <form action="<?= base_url() . 'index.php/exposicion/insertar_valoracion'; ?>" method="post">

            <input type="hidden" name="id_exposicion" value="<?= $_GET['id']; ?>">
            <label>Puntuación <span class="requerido">*</span></label>
            <div class="contenedor_puntuacion">
              <input id="star5" name="puntuacion" type="radio" value="5" class="radio-btn hide" />
              <label for="star5">&#9734;</label>
              <input id="star4" name="puntuacion" type="radio" value="4" class="radio-btn hide" />
              <label for="star4">&#9734;</label>
              <input id="star3" name="puntuacion" type="radio" value="3" class="radio-btn hide" />
              <label for="star3">&#9734;</label>
              <input id="star2" name="puntuacion" type="radio" value="2" class="radio-btn hide" />
              <label for="star2">&#9734;</label>
              <input id="star1" name="puntuacion" type="radio" value="1" class="radio-btn hide" />
              <label for="star1">&#9734;</label>
            </div>
            <label for="contenido">Contenido <span class="requerido">*</span></label>
            <textarea placeholder="Escribe tu valoracion" name="contenido" cols="30" rows="10"></textarea><br>
            <input type="submit" name="crear" value="Crear"><br><br>
          </form>
        </div>
        <link rel="stylesheet" href="<?= base_url(); ?>recursos/css/exposicion/puntuacion.css">
      </div>
      <br>
    <?php } ?>

    <!-- MOSTRAR VALORACIONES -->
    <div class="contenedor-secundario bg-white">
      <h2>Valoraciones</h2>
    </div>
    <?php
    if (isset($listaValoraciones)) {
      foreach ($listaValoraciones as $valoracion) { ?>
        <div class="contenedor-secundario bg-white valoracion">
          <p>Val. <b><?= $valoracion['puntuacion']; ?></b></p>
          <p>Contenido: <?= $valoracion['contenido']; ?></p>
          <?php if (isset($_SESSION['es_Admin'])) : ?>
            <form method="POST" action="<?= base_url() . 'index.php/exposicion/eliminar_valoracion'; ?>">
              <input type="hidden" name="id" value="<?= $valoracion['id']; ?>">
              <input type="hidden" name="id_exposicion" value="<?= $_GET['id']; ?>">
              <input type="submit" value="Eliminar">
            </form>
          <?php endif; ?>
        </div>
    <?php
      };
    }

    ?>
  </div>

  </div>
</main>
</body>

</html>