<main>

  <link rel="stylesheet" href="<?= base_url(); ?>recursos/css/comunidad/estilo.css">

  <div class="hero-img-full" style="background-image: url(<?= base_url() . 'recursos/img/hero-banner/jehyun-sung-6U5AEmQIajg-unsplash.jpg'; ?>)">
    <div class="hero-text">
      <h1>Comunidad</h1>
      <br>
      <h3>Crea y descubre obras creadas por nuestros usuarios
        <?php if (!isset($_SESSION['nick'])) : ?>
          <div>
            Inicia sesión ahora y comienza a dibujar
          </div>
        <?php endif; ?>
      </h3>
      <br>
      <?php if (isset($_SESSION['nick'])) : ?>
        <a class="btn btn-secundario" id="btn-ver-ahora">Herramienta Dibujo</a>
      <?php else : ?>
        <a class="btn btn-secundario" href="<?= base_url() . 'index.php/usuario/vista_login'; ?>">Iniciar sesión</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="clip-container-start" id="click-scroll">
    <div class="clip-start">
      <div class="scroll-down-arrow">
      </div>
    </div>
  </div>

  <!-- COMIENZO CONTENIDOS DE SECCION  -->
  <!-- BLOQUE 1 -->
  <div class="container-seccion">
    <div class="body-seccion container animacion-scroll">
      <div class="contenido-seccion">
        <div class="header-seccion">
          <h1>Saca tu Artista Interior</h1>
        </div>
        <div class="texto-seccion">
          Una vez creada una cuenta, tendras acceso a la <span class="texto-destacado-secundario">herramienta de dibujo</span>, donde podras compartir
          tu arte con el resto de la comunidad de manera simple y divertida tan solo tendras que darle
          un nombre a la obra despues de dibujar y listo.
          <br><br>
          Dentro de la herramienta contaras con la posibilidad de cambiar el color del pincel, su grosor
          y de resetear el lienzo, todo accesible mediante una interfaz muy sencilla. Una vez terminada
          solo tendras que darle un nombre y hacer click en 'Crear Obra'.
          <br><br>
          <a class="btn btn-secundario" href="#dibujo">Comenzar</a>
        </div>
      </div>
      <div class="img-seccion ocultar_movil" style="background-image: url(<?= base_url() . 'recursos/img/seccion/ashkan-forouzani-XLYqnzJlbNs-unsplash.jpg'; ?>)"></div>

    </div>
  </div>
  <!-- BLOQUE 2 -->
  <div class="container-seccion">
    <div class="body-seccion container animacion-scroll">
    <div class="img-seccion" style="background-image: url(<?= base_url() . 'recursos/img/seccion/markus-spiske-4W5WWKaxsKs-unsplash.jpg'; ?>)"></div>
      <div class="contenido-seccion">
        <div class="header-seccion">
          <h1>Nuestras Obras</h1>
        </div>
        <div class="texto-seccion">
          Descubre las obras que han creado otros usuarios utilizando la heramienta de dibujo.
          <br><br>
          Pasaras un buen rato riendote con las locuras de los demas, puedes encontrar todo 
          tipo de dibujos y usarlos de inspiración para crear tu propia obra.
          Si alguna obra se considera inapropiada será eliminada por un administrador.
          <br><br>
          <a class="btn btn-secundario" href="#obras">Visitar ahora</a>
        </div>
      </div>
    </div>
  </div>

  <div class="clip-container-end">
    <div class="clip-end">
    </div>
  </div>

  <a name="dibujo" class="anchor"></a>
  <div class="hero-img banner-seccion" style="background-image: url(<?= base_url() . 'recursos/img/hero-banner/kelly-sikkema-kDN490mHVjI-unsplash.jpg'; ?>)">
    <?php if (isset($_SESSION['nick'])) : ?>
      <div class="contenedor-dibujo container">
        <div>
          <div>
            <!-- lienzo y coordenadas -->
            <div class="bg-white" style="margin: .2rem auto; width:min-content">
              <div class="ocultar_movil" id="coordenadas" style="text-align: center">(?,?)</div>
              <canvas id="lienzo"></canvas>
            </div>
            <!-- herramientas y formulario -->
            <div class="contenedor-secundario bg-white" style="margin: .2rem auto; border-radius: 4px; max-width: 625px">
              <div class="contenedor_herramientas ">
                <div class="bloque_herramientas">
                  <div class="icono_grande" id="color_actual"></div>
                </div>
                <div class="bloque_herramientas" id="contenedor_selector_color">
                  <div id="contenedor_colores"></div>
                </div>
                <div class="bloque_herramientas">
                  <div class="seleccionable item-bt icono_grande boton_grosor fino" id="1"></div>
                  <div class="seleccionable item-bt icono_grande boton_grosor medio" id="3"></div>
                  <div class="seleccionable item-bt icono_grande boton_grosor grueso" id="5"></div>
                  <div class="seleccionable item-bt icono_grande" id="boton_limpiar"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="enviar-obra bg-white">
            <form method="post" action="<?= base_url() . 'index.php/comunidad/insertar_obra'; ?>" enctype="multipart/form-data" onsubmit="imagenFormulario()">
              <input class="btn" type="text" name="titulo" maxlength="35" placeholder="Titulo de la obra" required><br>
              <input type="hidden" name="datosImagen" id="datosImagen">
              <input class="btn btn-secundario" type="submit" value="Crear Obra">
            </form>
          </div>
        </div>
      </div>
      <script src="<?= base_url(); ?>recursos/javascript/comunidad/logicaLienzo.js"></script>
      <script src="<?= base_url(); ?>recursos/javascript/comunidad/subirImagen.js"></script>
    <?php else : ?>
      <div class="banner-content">
        <div class="banner-text">
          <h1>¿Quieres comenzar a <span class="texto-destacado-secundario">crear</span>?<h1><br>
              <a class="btn btn-secundario" href="<?= base_url() . 'index.php/usuario/vista_login'; ?>">Iniciar Sesión</a>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <a name="obras"></a>
  <?php
  if (isset($listaObras)) : ?>
    <!-- HEADER LISTA -->

    <div class="container">
      <div class="seccion-header-block">
        <div class="seccion-header-text">
          <hr>
          <h1>Visita la Colección de Obras</h1>
          <p> 
            Todas las obras compartidas por los usuarios quedan guardadas junto a su titulo y son 
            visibles para el resto de los visitantes, podrás encontrar todo tipo de obras divertidas 
            y originales creadas por otros usuarios.
          </p>
        </div>
      </div>
    </div>
    <img class="seccion-header-img" src="<?= base_url() . 'recursos/img/daniele-levis-pelusi-ENdi1TkM1QQ-unsplash.jpg'; ?>" alt="landscape comunidad">

    <!-- BODY LISTA -->
    <div class="container">
      <div class="contenedor-secundario contenedor-rejilla">
        <?php
        foreach ($listaObras as $obra) : ?>
          <div class="exposicion_tarjeta obra">
            <div class="exposicion_header">
              <h3 class="exposicion_header_titulo"><?= $obra['titulo']; ?></h3>
              <h3 class="exposicion_header_subtitulo"><?= $obra['autor']; ?></h3>
            </div>
            <img src="<?= base_url() . $obra['ubicacion']; ?>" /><br>
            <?php if (isset($_SESSION['es_Admin'])) : ?>
              <form action="<?= base_url() . 'index.php/comunidad/eliminar_obra'; ?>" method="post">
                <input type="hidden" name="id" value="<?= $obra['id']; ?>">
                <input type="hidden" name="ubicacion" value="<?= $obra['ubicacion']; ?>">
                <input type="submit" value="Eliminar">
              </form>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
  </div>
</main>
</body>

</html>