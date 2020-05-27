<?php
class Exposicion extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Exposicion_model');
    $this->load->model('Usuario_model');
    $this->load->model('Multimedia_model');
  }

  public function vista_general()
  {
    $data['listaExposiciones'] = $this->Exposicion_model->buscar_exposicion();
    if (isset($_SESSION['id'])) {
      $data['listaFavoritos'] = $this->Exposicion_model->buscar_favoritos_por_usuario($_SESSION['id']);
    }
    $this->load->view('cabecera', ['titulo' => 'Exposiciones']);
    $this->load->view('exposicion', $data);
  }

  public function vista_exposicion_creacion($error = false)
  {
    if (isset($_SESSION['es_Admin'])) {
      $this->load->view('cabecera', ['titulo' => 'Crear Exposición']);
      $this->load->view('exposicion_creacion', $error);
    } else {
      redirect('exposicion/vista_general');
    }
  }

  public function vista_exposicion_individual()
  {
    if (isset($_GET['id'])) {
      $data = $this->Exposicion_model->buscar_exposicion($_GET['id']);
      $data['listaContenidos'] = $this->Exposicion_model->buscar_contenido($_GET['id']);
      $data['listaValoraciones'] = $this->Exposicion_model->buscar_valoracion($_GET['id']);
      if (isset($_SESSION['id'])) {
        $data['estadoFavoritos'] = $this->estaEnFavoritos($_SESSION['id'], $_GET['id']);
      }
      $this->Exposicion_model->incrementar_visitas($_GET['id'], $data['num_visitas']);
      $this->load->view('cabecera', ['titulo' => 'Ver Exposición']);
      $this->load->view('exposicion_individual', $data);
    } else {
      redirect('exposicion/vista_general');
    }
  }

  public function insertar_exposicion()
  {
    if (isset($_POST['crear']) && isset($_SESSION['es_Admin'])) {
      //Archivo subido para la Portada.
      if (isset($_FILES['portada'])) {
        $resultado = $this->Multimedia_model->subir_archivo($_FILES['portada'], '/imagenes/imagenes_exposicion/portada/');
        if ($resultado) {
          $data = [];
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
    redirect('exposicion/vista_general');
  }

  public function subir_contenido_exposicion()
  {
    //Archivos subidos para el contenido.
    if (isset($_POST['subir']) && isset($_SESSION['es_Admin'])) {
      if (isset($_FILES['contenido'])) {
        $resultado = $this->Multimedia_model->subir_archivo($_FILES['contenido'], '/imagenes/imagenes_exposicion/contenido/');
        if ($resultado) {
          $data = [];
          $data['id_exposicion'] = $_POST['id_exposicion'];
          $data['ubicacion'] = $resultado;
          $data['comentario'] = $_POST['comentario'];
          $this->Exposicion_model->insertar_contenido_exposicion($data);
        }
      }
      redirect('exposicion/vista_exposicion_individual?id=' . $_POST['id_exposicion']);
    } else {
      redirect('usuario/vista_administracion');
    }
  }

  public function eliminar_exposicion()
  {
    if (isset($_SESSION['es_Admin'])) {
      $datosRecibidos = json_decode($_POST['exposicion']);
      if ($this->Multimedia_model->eliminar_imagen($datosRecibidos->portada)) {
        $data['id'] = $datosRecibidos->id;
        $this->Exposicion_model->eliminar_exposicion($data);
        $this->Exposicion_model->eliminar_todo_contenido_exposicion($data);
        $this->Exposicion_model->eliminar_valoraciones_exposicion($data);
      }
      redirect('exposicion/vista_general');
    }
  }

  public function eliminar_contenido()
  {
    if (isset($_SESSION['es_Admin'])) {
      $data['id'] = $_POST['id_contenido'];
      if ($this->Multimedia_model->eliminar_imagen($_POST['ubicacion'])) {
        $this->Exposicion_model->eliminar_contenido_exposicion($data);
      }
      redirect('exposicion/vista_exposicion_individual?id=' . $_POST['id_exposicion']);
    }
  }

  public function eliminar_valoracion()
  {
    if (isset($_SESSION['es_Admin'])) {
      var_dump($_POST['exposicion']);
      $data['id'] = $_POST['id'];
      $this->Exposicion_model->eliminar_valoracion($data);
      redirect('exposicion/vista_exposicion_individual?id=' . $_POST['id_exposicion']);
    }
  }

  public function insertar_valoracion()
  {
    if (isset($_SESSION['id'])) {
      /* si existe alguna valoracion previa en la misma exposicion se elimina */
      $resultado = $this->Exposicion_model->buscar_valoracion_anterior($_SESSION['id'], $_POST['id_exposicion']);
      if ($resultado != null) {
        $this->Exposicion_model->eliminar_valoracion($resultado);
      }
      /* se inserta la valoracion */
      $data['puntuacion'] = $_POST['puntuacion'];
      if (!is_numeric($data['puntuacion']) || $data['puntuacion'] < 0 || $data['puntuacion'] > 5) {
        $data['puntuacion'] = 0;
      }
      $data['contenido'] = $_POST['contenido'];
      $data['id_usuario'] = $_SESSION['id'];
      $data['id_exposicion'] = $_POST['id_exposicion'];
      $this->Exposicion_model->insertar_valoracion($data);

      redirect('exposicion/vista_exposicion_individual?id=' . $_POST['id_exposicion']);
    }
  }


  public function switch_favoritos()
  {
    if (isset($_SESSION['nick'])) {
      $data['id_usuario'] = $_POST['id_usuario'];
      $data['id_exposicion'] = $_POST['id_exposicion'];
      if ($this->estaEnFavoritos($data['id_usuario'], $data['id_exposicion'])) {
        $this->Usuario_model->eliminar_favorito($data);
      } else {
        $this->Usuario_model->insertar_favorito($data);
      }
    }
    redirect('exposicion/vista_exposicion_individual?id=' . $data['id_exposicion']);
  }

  public function estaEnFavoritos($id_usuario, $id_exposicion)
  {
    $listaFavoritos = $this->Exposicion_model->buscar_favoritos_por_usuario($id_usuario);
    foreach ($listaFavoritos as $favorito) {
      if ($favorito['id_exposicion'] == $id_exposicion) {
        return true;
      }
    }
    return false;
  }
}
