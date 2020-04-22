<?php
class Otros extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function vista_sobre_nosotros()
  {
    $this->load->view('cabecera', ['titulo' => 'Sobre Nosotros']);
    $this->load->view('sobre_nosotros');
  }
}
