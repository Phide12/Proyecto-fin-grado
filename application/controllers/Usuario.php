<?php
class Usuario extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Usuario_model');
    $this->load->model('Exposicion_model');
  }

  public function vista_login()
  {
    $this->load->view('cabecera', ['titulo' => 'Inicio']);
    $this->load->view('login');
  }

  public function vista_registro()
  {
    $this->load->view('cabecera', ['titulo' => 'Inicio']);
    $this->load->view('registro');
  }

  public function vista_perfil()
  {
    if (isset($_SESSION['nick'])) {
      $data = $this->Usuario_model->buscar_usuario($_SESSION['nick']);
      $this->load->view('cabecera', ['titulo' => 'Perfil']);
      $this->load->view('perfil', $data);
    }
  }

  public function vista_administracion()
  {
    if (isset($_SESSION['es_Admin'])) {
      $data['titulo'] = 'Administracion';
      $data['listaUsuarios'] = $this->Usuario_model->buscar_usuario();
      $data['listaExposiciones'] = $this->Exposicion_model->buscar_exposicion();
      $this->load->view('cabecera', $data);
      $this->load->view('administracion');
    }
  }

  public function modificar_usuario()
  {
    if (isset($_SESSION['nick'])) {

      $data['nick'] = $_SESSION['nick'];
      $data['nombre'] = $this->input->post('nombre');
      $data['apellidos'] = $this->input->post('apellidos');
      $data['email'] = $this->input->post('email');

      $this->Usuario_model->modificar_usuario($data);
      $this->vista_perfil();
    }
  }

  public function modificar_contrasena()
  {
    if (isset($_SESSION['nick'])) {
      if ($this->input->post('contrasena_nueva1') == $this->input->post('contrasena_nueva2')) {

        $contrasenaAntigua = $this->input->post('contrasena_antigua');
        $contrasenaNueva = $this->input->post('contrasena_nueva1');

        $resultado = $this->Usuario_model->buscar_usuario($_SESSION['nick']);
        if ($this->encriptador->verificarHash($contrasenaAntigua, $resultado['contrasena'])) {
          $this->Usuario_model->cambiar_contrasena($_SESSION['nick'], $contrasenaNueva);
        }
        $this->vista_perfil();
      }
    }
  }

  public function modificar_usuario_admin()
  {
    if (isset($_SESSION['es_Admin'])) {
      $data = [
        'nick' => $this->input->post('nick'),
        'nombre' => $this->input->post('nombre'),
        'apellidos' => $this->input->post('apellidos'),
        'email' => $this->input->post('email')
      ];
      $this->Usuario_model->modificar_usuario($data);
      $this->vista_administracion();
    }
  }

  public function eliminar_usuario()
  {
    if (isset($_SESSION['es_Admin'])) {
      $data['nick'] = $this->input->post('nick');
      $this->Usuario_model->eliminar_usuario($data);
      $this->vista_administracion();
    }
  }

  public function insertar_usuario()
  {
    $data['nick'] = $this->input->post('nick');
    if ($this->Usuario_model->buscar_usuario($data['nick']) == null) {
      $data['contrasena'] = $this->input->post('contrasena');
      $data['nombre'] = $this->input->post('nombre');
      $data['apellidos'] = $this->input->post('apellidos');
      $data['email'] = $this->input->post('email');
      $data['es_Admin'] = 0;
      $this->Usuario_model->insertar_usuario($data);
    }

    $this->vista_login();
  }

  public function comprobar_login()
  {
    $data = [
      'nick' => $this->input->post('nick'),
      'contrasena' => $this->input->post('contrasena')
    ];
    $comprobarUsuario = $this->Usuario_model->buscar_usuario($data['nick']);
    if ($comprobarUsuario != null && $this->encriptador->verificarHash($data['contrasena'], $comprobarUsuario['contrasena'])) {
      $_SESSION['id'] = $comprobarUsuario['id'];
      $_SESSION['nick'] = $comprobarUsuario['nick'];
      $_SESSION['nombre'] = $comprobarUsuario['nombre'];
      if ($comprobarUsuario['es_Admin'] == 1) {
        $_SESSION['es_Admin'] = 1;
      }
      $this->vista_perfil();
    } else {
      $this->vista_login();
    }
  }

  public function cerrar_sesion()
  {
    unset($_SESSION['nick']);
    unset($_SESSION['es_Admin']);
    $this->vista_login();
  }
}
