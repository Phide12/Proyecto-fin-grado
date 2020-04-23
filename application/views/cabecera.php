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
    <span class="icono_menu" id="boton_abrir_menu">
      &#9776;
    </span>
    <h1>
      <?php echo $titulo; ?>
    </h1>

    <?php if (isset($_SESSION['nick'])) : ?>
      <span class="mensaje_usuario">Buenas, <?php echo $_SESSION['nick'] ?>.
        <a href="<?php echo base_url() . 'index.php/usuario/vista_perfil'; ?>">Perfil</a>
        <a href="<?php echo base_url() . 'index.php/usuario/cerrar_sesion'; ?>">Cerrar sesion</a>
      </span>
    <?php else : ?>
      <span class="mensaje_usuario">¿Estas registrado?
        <a href="<?php echo base_url() . 'index.php/usuario/vista_login'; ?>">Iniciar Sesion</a>/
        <a href="<?php echo base_url() . 'index.php/usuario/vista_registro'; ?>">Registrarse</a>
      </span>
    <?php endif; ?>

    <nav id="sideNav" class="sidenav-main">
      <a id="boton_cerrar_menu">&times;</a>
      <a href="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>">Inicio</a>
      <a href="<?php echo base_url() . 'index.php/comunidad/vista_comunidad'; ?>">Comunidad</a>
      <a href="<?php echo base_url() . 'index.php/otros/vista_sobre_nosotros'; ?>">Sobre Nosotros</a>
      <?php if (isset($_SESSION['es_Admin'])) : ?>
        <a href="<?php echo base_url() . 'index.php/usuario/vista_administracion'; ?>">Administracion</a>
      <?php endif; ?>
      <?php if (isset($_SESSION['nick'])) : ?>
        <a href="<?php echo base_url() . 'index.php/usuario/vista_perfil'; ?>">Perfil</a>
        <a href="<?php echo base_url() . 'index.php/usuario/cerrar_sesion'; ?>">Cerrar sesion</a>
      <?php endif; ?>
    </nav>
  </header>