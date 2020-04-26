<!DOCTYPE html>
<html>

<head>
  <title>proyecto_JorgeM</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url() . "recursos/css/estilo.css"; ?>">
  <script src="<?php echo base_url(); ?>recursos/javascript/cargarCabecera.js"></script>
</head>

<body>

  <header class="header-main">
    <a class="icon_menu item-bt" id="boton_abrir_menu">
    </a>
    <h1 class="page_title">
      <?php echo $titulo; ?>
    </h1>

    <?php if (isset($_SESSION['nick'])) : ?>
      <span class="mensaje_user">Buenas, <?php echo $_SESSION['nick'] ?>.
        <a href="<?php echo base_url() . 'index.php/usuario/vista_perfil'; ?>">Perfil</a> /
        <a href="<?php echo base_url() . 'index.php/usuario/cerrar_sesion'; ?>">Cerrar sesión</a>
      </span>
    <?php else : ?>
      <span class="mensaje_user">¿Estas registrado?
        <a href="<?php echo base_url() . 'index.php/usuario/vista_login'; ?>">Iniciar Sesión</a> /
        <a href="<?php echo base_url() . 'index.php/usuario/vista_registro'; ?>">Registrarse</a>
      </span>
    <?php endif; ?>

    <nav id="sideNav" class="sidenav-main">
      <a class="item-bt" id="boton_cerrar_menu"></a>
      <div class="lista">
        <a href="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>">Inicio</a>
        <a href="<?php echo base_url() . 'index.php/comunidad/vista_comunidad'; ?>">Comunidad</a>
        <a href="<?php echo base_url() . 'index.php/otros/vista_sobre_nosotros'; ?>">Sobre Nosotros</a>
        <?php if (isset($_SESSION['es_Admin'])) : ?>
          <a href="<?php echo base_url() . 'index.php/usuario/vista_administracion'; ?>">Administración</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['nick'])) : ?>
            <a href="<?php echo base_url() . 'index.php/usuario/vista_perfil'; ?>">Perfil</a>
            <a href="<?php echo base_url() . 'index.php/usuario/cerrar_sesion'; ?>">Cerrar sesión</a>
        <?php else : ?>
            <a href="<?php echo base_url() . 'index.php/usuario/vista_login'; ?>">Iniciar Sesión</a>
            <a href="<?php echo base_url() . 'index.php/usuario/vista_registro'; ?>">Registrarse</a>
        <?php endif; ?>
      </div>
    </nav>
  </header>
  <div id="filtro_oscuro" ></div>