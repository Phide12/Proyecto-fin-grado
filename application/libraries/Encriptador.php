<?php
  class Encriptador {
     private $metodo = 'aes-192-cbc';
     private $llave = 'deJudo58b7Au';
     private $constante = OPENSSL_RAW_DATA;
     private $iv = 'fgRTsfAd7d4523pO';

     function cifrar($valor) {
      $encriptacion = openssl_encrypt($valor, $this->metodo, $this->llave, $this->constante, $this->iv);
      return base64_encode($encriptacion);
     }

     function descifrar($valor) {
       $descodificacion = base64_decode($valor);
      return openssl_decrypt($descodificacion, $this->metodo, $this->llave,  $this->constante, $this->iv);    
    }

    function hashear($valor) {
      $hasheo = password_hash($valor, PASSWORD_BCRYPT);
      return base64_encode($hasheo);
    }

    function verificarHash($contrasena, $hasheo) {
      return password_verify($contrasena, base64_decode($hasheo));
    }
  }
?>