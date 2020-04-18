<?php
class Exposicion extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Exposicion_model');
    $this->load->model('Usuario_model');
    $this->load->model('Multimedia_model');
    $this->load->helper('url_helper');
    $this->load->helper('form');
  }

  public function vista_general()
  {
    $data['listaExposiciones'] = $this->Exposicion_model->buscar_exposicion();
    $this->load->view('cabecera', ['titulo' => 'Exposicion']);
    $this->load->view('exposicion', $data);
  }

  public function vista_creacion_exposicion()
  {
    if (isset($_SESSION['es_Admin'])) {
      //$data['listaExposiciones'] = $this->Exposicion_model->buscar_exposicion();
      $this->load->view('cabecera', ['titulo' => 'Exposicion']);
      $this->load->view('creacion_exposicion');
    }
  }
  public function insertar_exposicion()
  {
    if (isset($_POST['crear']) && isset($_SESSION['es_Admin'])) {

      //Archivo subido para la Portada.
      if (isset($_FILES['portada'])) {
        $this->Multimedia_model->subir_archivo($_FILES['portada'], '/imagenes/imagenes_exposicion/portada/');
      }

      //Archivos subidos para el contenido.
      if (isset($_FILES['contenido'])) {
        $cantidadArchivos = count($_FILES['contenido']['name']);
        // Recorre todos los archivos subidos y los sube uno a uno.
        for ($i = 0; $i < $cantidadArchivos; $i++) {
          $archivo["name"] = ($_FILES['contenido']['name'][$i]);
          $archivo["type"] = ($_FILES['contenido']['type'][$i]);
          $archivo["tmp_name"] = ($_FILES['contenido']['tmp_name'][$i]);
          $archivo["error"] = ($_FILES['contenido']['error'][$i]);
          $archivo["size"] = ($_FILES['contenido']['size'][$i]);
          $this->Multimedia_model->subir_archivo($archivo, '/imagenes/imagenes_exposicion/contenido/');
        }
        $this->vista_general();
      }
      

      /* // Count total files
      $countfiles = count($_FILES['file']['name']);

      // Looping all files
      for ($i = 0; $i < $countfiles; $i++) {
        $directorio = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['SCRIPT_NAME'] . "/../imagenes/imagenes_exposicion/";
        $filename = $_FILES['file']['name'][$i];
        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'][$i], $directorio . $filename);
      } */
    }
    //$this->Multimedia_model->subir_imagen_formulario('portada');
    /* if (isset($_SESSION['es_Admin'])) {
      $data['titulo'] = $this->input->post('titulo');
      $resultado = $this->Exposicion_model->buscar_exposicion($data['titulo']);
      $data['descripcion'] = $this->input->post('descripcion');
      $data['valoracion'] = $this->input->post('valoracion');
      $resultado = $this->Exposicion_model->buscar_exposicion($data['titulo']);
      if ($resultado == null) {
        $data = $this->Exposicion_model->insertar_exposicion($data);
      }
      $this->vista_general();
    } */
  }

  public function modificar_exposicion()
  {
    if ($_SESSION['es_Admin'] == 1) {
      $data['id'] = $this->input->post('id');
      $data['titulo'] = $this->input->post('titulo');
      $data['descripcion'] = $this->input->post('descripcion');
      $data['valoracion'] = $this->input->post('valoracion');

      $this->Exposicion_model->modificar_exposicion($data);
      $this->vista_general();
    }
  }

  public function eliminar_exposicion()
  {
    if ($_SESSION['es_Admin'] == 1) {
      $data['id'] = $this->input->post('id');
      $this->Exposicion_model->eliminar_exposicion($data);
      $this->vista_general();
    }
  }
}
