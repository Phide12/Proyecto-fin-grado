<!DOCTYPE html>
<html>

<head>
  <title>CloudGallery - <?= $titulo ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url() . "recursos/css/estilo.css"; ?>">
  <script defer src="<?= base_url(); ?>recursos/javascript/global.js"></script>
</head>

<body>

  <header class="header">
    <div class="container">
      <div class="header-main">
        <a class="icon_menu item-bt" id="boton_abrir_menu">
        </a>
        <h1 class="page_title"><a href="<?= base_url() . 'index.php/exposicion/vista_general'; ?>">CloudGallery</a></h1>
        <?php if (isset($_SESSION['nick'])) : ?>
          <span class="mensaje_user ocultar_movil">Buenas, <?= $_SESSION['nick'] ?>.
            <a href="<?= base_url() . 'index.php/usuario/vista_perfil'; ?>">Perfil</a> /
            <a href="<?= base_url() . 'index.php/usuario/cerrar_sesion'; ?>">Cerrar sesión</a>
          </span>
        <?php else : ?>
          <span class="mensaje_user ocultar_movil">¿Estas registrado?
            <a href="<?= base_url() . 'index.php/usuario/vista_login'; ?>">Iniciar Sesión</a> /
            <a href="<?= base_url() . 'index.php/usuario/vista_registro'; ?>">Registro</a>
          </span>
        <?php endif; ?>

        <nav id="sideNav" class="sidenav-main">
          <a class="item-bt" id="boton_cerrar_menu"></a>
          <div class="lista">
            <a href="<?= base_url() . 'index.php/exposicion/vista_general'; ?>">Exposiciones</a>
            <a href="<?= base_url() . 'index.php/comunidad/vista_comunidad'; ?>">Comunidad</a>
            <?php if (isset($_SESSION['es_Admin'])) : ?>
              <a href="<?= base_url() . 'index.php/usuario/vista_administracion'; ?>">Administración</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['nick'])) : ?>
              <a href="<?= base_url() . 'index.php/usuario/vista_perfil'; ?>">Perfil</a>
              <a href="<?= base_url() . 'index.php/usuario/cerrar_sesion'; ?>">Cerrar sesión</a>
            <?php else : ?>
              <a href="<?= base_url() . 'index.php/usuario/vista_login'; ?>">Iniciar Sesión</a>
              <a href="<?= base_url() . 'index.php/usuario/vista_registro'; ?>">Registrarse</a>
            <?php endif; ?>
          </div>
          <ul class="info_autor">
            <li>
              <h4>Otros trabajos</h4>
            </li>
            <a href="https://phide12.github.io/PlantillaWeb/">
              <li>Plantilla Web</li>
            </a>
            <a href="https://phide12.github.io/calculadora_JS/">
              <li>Calculadora</li>
            </a>
          </ul>
        </nav>
      </div>
    </div>
    <div class="header-sub">
      <div class="container">
       <div class="header-sub-content"> 
        <?= $titulo; ?>
       </div>
      </div>
    </div>
  </header>
  <div id="filtro_oscuro"></div>