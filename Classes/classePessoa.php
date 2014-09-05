<?php
  abstract class Pessoa {
   
    var $documento;
    var $nome;
    var $fone;
    //endereço:
    var $rua;
    var $numero;
    var $bairro;
    var $cidade;
    var $cep;
    
    //metodos get:
    function getDoc() {
          return $this->documento;
    }
    function getNome() {
      return $this->nome;
    }
    function getFone() {
      return $this->fone;
    }
    function getRua() {
      return $this->rua;
    }
    function getNumero() {
      return $this->numero;
    }
    function getBairro() {
      return $this->bairro;
    }
    function getCidade() {
      return $this->cidade;
    }
    function getCEP() {
      return $this->cep;
    }
    
    //metodos set:
    function setDoc($documento) {
      $this->id = $documento;
    }
    function setNome($nome) {
      $this->nome = $nome;
    }
    function setFone($fone) {
      $this->fone = $fone;
    }
    function setRua($rua) {
      $this->rua = $rua;
    }
    function setNumero($numero) {
      $this->numero = $numero;
    }
    function setBairro($bairro) {
      $this->bairro = $bairro;
    }
    function setCidade($cidade) {
      $this->cidade = $cidade;
    }
    function setCEP($cep) {
      $this->cep = $cep;
    }
    
    
  }
?>