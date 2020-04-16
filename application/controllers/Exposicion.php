<?php
class Exposicion extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Exposicion_model');
    $this->load->model('Usuario_model');
    $this->load->helper('url_helper');
    $this->load->helper('form');
  }

  public function view()
  {
    if (isset($_SESSION['nick'])) {
      if (isset($_SESSION['idioma'])) {
        $this->lang->load('mensajes', $_SESSION['idioma']);
      } else {
        $this->lang->load('mensajes', 'eng');
      }
      $data['listaExposiciones'] = $this->Exposicion_model->buscar_exposicion();
      $this->load->view('cabecera', ['titulo' => 'Exposicion']);
      $this->load->view('exposicion', $data);
    }
  }

  public function insertar_exposicion()
  {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['SCRIPT_NAME'] . "/../imagenes/imagenes_exposicion/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    /* if (isset($_SESSION['es_Admin'])) {
      $data['titulo'] = $this->input->post('titulo');
      $resultado = $this->Exposicion_model->buscar_exposicion($data['titulo']);
      $data['descripcion'] = $this->input->post('descripcion');
      $data['valoracion'] = $this->input->post('valoracion');
      $resultado = $this->Exposicion_model->buscar_exposicion($data['titulo']);
      if ($resultado == null) {
        $data = $this->Exposicion_model->insertar_exposicion($data);
      }
      $this->view();
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
      $this->view();
    }
  }

  public function eliminar_exposicion()
  {
    if ($_SESSION['es_Admin'] == 1) {
      $data['id'] = $this->input->post('id');
      $this->Exposicion_model->eliminar_exposicion($data);
      $this->view();
    }
  }
}
