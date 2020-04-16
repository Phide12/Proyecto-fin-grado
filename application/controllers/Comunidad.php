<?php
class Comunidad extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Comunidad_model');
    $this->load->model('Multimedia_model');

  }

  public function vista_comunidad()
  {
    if (isset($_SESSION['nick'])) {
      $data = $this->Comunidad_model->buscar_obra();
      $this->load->view('cabecera', ['titulo' => 'Comunidad']);
      $this->load->view('comunidad', $data);
    }
  }

  

  public function eliminar_obra()
  {
    if ($_SESSION['es_Admin'] == 1) {
      $data['id'] = $this->input->post('id');
      $resultado = $this->Multimedia_model->eliminar_imagen($this->input->post('ubicacion'));
        if ($resultado) {
          $this->Comunidad_model->eliminar_obra($data);
        }
      
    }
    $this->vista_comunidad();
  }

  public function insertar_obra()
  {
    if (isset($_SESSION['nick']) && isset($_SESSION['nombre'])) {
      $data['titulo'] = $this->input->post('titulo');
      if ($this->Comunidad_model->buscar_obra($data['titulo']) == null) {
        $resultado = $this->Multimedia_model->subir_imagen($this->input->post('datosImagen'));
        if ($resultado) {
          $data['ubicacion'] = $resultado;
          $data['autor'] = $_SESSION['nombre'];
          $this->Comunidad_model->insertar_obra($data);
        }
      }      
    }

    $this->vista_comunidad();
  }

  
}
