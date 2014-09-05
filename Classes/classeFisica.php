<?php
  include_once("classePessoa.php");
  class Fisica extends Pessoa {
   
    var $cpf;
    var $rg;
    var $sexo;
    var $mail;
    var $senha;
    var $permissao;
    
    //metodos get:
    function getCPF() {
      return $this->cpf;
    }
    function getRG() {
      return $this->rg;
    }
    function getSexo() {
      return $this->sexo;
    }
    function getMail() {
      return $this->mail;
    }
    function getSenha() {
      return $this->senha;
    }
    function getPermissao() {
      return $this->permissao;   
    }
    
    //metodos set:
    function setCPF($cpf) {
      $this->cpf = $cpf;
    }
    function setRG($rg) {
      $this->rg = $rg;
    }
    function setSexo($sexo) {
      $this->sexo = $sexo;
    }
    function setMail($mail) {
      $this->mail = $mail;
    }
    function setSenha($senha) {
      $this->senha = $senha;
    }
    function setPermissao($permissao) {
      $this->permissao = $permissao;
    }
    
  }
?>
