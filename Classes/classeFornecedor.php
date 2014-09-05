<?php
  include_once("classePessoa.php");
  class Fornecedor extends Pessoa {
    var $mail;
    var $cnpj;
    
    //metodos get:
    function getMail() {
      return $this->mail;
    }
    function getCNPJ() {
      return $this->cnpj;
    }
    
    //metodos set:
    function setMail($mail) {
      $this->mail = $mail;
    }
    function setCNPJ($cnpj) {
      $this->cnpj = $cnpj;
    }
    
  }
?>