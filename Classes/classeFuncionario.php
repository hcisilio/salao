<?php
  include_once ("classeFisica.php");
  class Funcionario extends Fisica {
   
    var $cpf;
	var $funcao;
    var $entrada;
    var $saida;
    var $comissao;
    var $salario;
    
    //metodos get:
	function getCPF(){
		return $this->cpf;
	}
    function getFuncao() {
      return $this->funcao;
    }
    function getEntrada() {
      return $this->entrada;
    }
    function getSaida() {
      return $this->saida;
    }
    function getComissao() {
      return $this->comissao;
    }
    function getSalario() {
      return $this->salario;
    }
    
    //metodos set:
    function setCPF($cpf){
		$this->cpf = $cpf;
	}
    function setFuncao($funcao) {
      $this->funcao = $funcao;
    }
    function setEntrada($entrada) {
      $this->entrada = $entrada;
    }
    function setSaida($saida) {
      $this->saida = $saida;
    }
    function setComissao($comissao) {
      $this->comissao = $comissao;
    }
    function setSalario($salario) {
      $this->salario = $salario;
    }
    
    
  }
?>