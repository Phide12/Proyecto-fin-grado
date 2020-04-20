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

  public function vista_exposicion_creacion($error = false)
  {
    if (isset($_SESSION['es_Admin'])) {
      $this->load->view('cabecera', ['titulo' => 'Exposicion']);
      $this->load->view('exposicion_creacion', $error);
    }
  }

  public function vista_exposicion_individual()
  {
    if (isset($_GET['id'])) {
      $data = $this->Exposicion_model->buscar_exposicion($_GET['id']);
      $data['listaContenidos'] = $this->Exposicion_model->buscar_contenido($_GET['id']);
      $data['listaValoraciones'] = $this->Exposicion_model->buscar_valoracion($_GET['id']);
      $this->load->view('cabecera', ['titulo' => 'Exposicion']);
      $this->load->view('exposicion_individual', $data);
      $this->Exposicion_model->incrementar_visitas($_GET['id'], $data['num_visitas']);
    } else {
      $this->vista_general();
    }
  }

  public function insertar_exposicion()
  {
    if (isset($_POST['crear']) && isset($_SESSION['es_Admin'])) {
      //Archivo subido para la Portada.
      if (isset($_FILES['portada'])) {
        $data = [];
        $resultado = $this->Multimedia_model->subir_archivo($_FILES['portada'], '/imagenes/imagenes_exposicion/portada/');
        if ($resultado) {
          $data['portada'] = $resultado;
          $data['titulo'] = $_POST['titulo'];
          $data['autor'] = $_POST['autor'];
          $data['descripcion'] = $_POST['descripcion'];
          $this->Exposicion_model->insertar_exposicion($data);
        } else {
          $this->vista_exposicion_creacion(['error' => 'Error al subir la portada']);
          return;
        }
      }
    }
    $this->vista_general();
  }

  public function subir_contenido_exposicion()
  {
    //Archivos subidos para el contenido.
    if (isset($_POST['subir']) && isset($_SESSION['es_Admin'])) {
      if (isset($_FILES['contenido'])) {
        $data = [];
        $resultado = $this->Multimedia_model->subir_archivo($_FILES['contenido'], '/imagenes/imagenes_exposicion/contenido/');
        if ($resultado) {
          $data['id_exposicion'] = $_POST['id_exposicion'];
          $data['ubicacion'] = $resultado;
          $data['comentario'] = $_POST['comentario'];
          $this->Exposicion_model->insertar_contenido_exposicion($data);
        } else {
          $_GET['id'] = $_POST['id_exposicion'];
          $this->vista_exposicion_individual(['error' => 'Error al subir el archivo']);
          return;
        }
      }
      $_GET['id'] = $_POST['id_exposicion'];
      $this->vista_exposicion_individual();
    } else {
      $this->vista_general();
    }
  }

  public function modificar_exposicion()
  {
    if ($_SESSION['es_Admin'] == 1) {
      $data['id'] = $_POST['id'];
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
      $data['id'] = $_POST['id'];
      if ($this->Multimedia_model->eliminar_imagen($_POST['portada'])) {
        $this->Exposicion_model->eliminar_exposicion($data);
        $this->Exposicion_model->eliminar_todo_contenido_exposicion($data);
        $this->Exposicion_model->eliminar_valoraciones_exposicion($data);

      }
      $this->vista_general();
    }
  }

  public function eliminar_contenido()
  {
    if ($_SESSION['es_Admin'] == 1) {
      $data['id'] = $_POST['id_contenido'];
      $_GET['id'] = $_POST['id_exposicion'];
      if ($this->Multimedia_model->eliminar_imagen($_POST['ubicacion'])) {
        $this->Exposicion_model->eliminar_contenido_exposicion($data);
      }
      $this->vista_exposicion_individual();
    }
  }

  public function eliminar_valoracion()
  {
    if ($_SESSION['es_Admin'] == 1) {
      $data['id'] = $_POST['id'];
      $this->Exposicion_model->eliminar_valoracion($data);
      header('location: ' . base_url() . 'index.php/exposicion/vista_exposicion_individual?id=' . $_POST['id_exposicion']);
    }
  }

  public function insertar_valoracion()
  {
    if (isset($_POST['crear']) && isset($_SESSION['nick'])) {
      //Archivo subido para la Portada.
      $data['puntuacion'] = $_POST['puntuacion'];
      $data['contenido'] = $_POST['contenido'];
      $data['id_usuario'] = $_SESSION['id'];
      $data['id_exposicion'] = $_POST['id_exposicion'];
      $this->Exposicion_model->insertar_valoracion($data);
      header('location: ' . base_url() . 'index.php/exposicion/vista_exposicion_individual?id=' . $_POST['id_exposicion']);
    }
  }
}
