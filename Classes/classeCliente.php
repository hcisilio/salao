<?php
  include_once ("classeFisica.php");
  class Cliente extends Fisica {
   
    var $cpf;
	var $nasc;
    var $obs;
    
    //metodos get;
	function getCPF(){
		return $this->cpf;
	}
    function getNasc() {
      return $this->nasc;
    }
    function getObs() {
      return $this->obs;
    }
    
    //metodos set:
    function setCPF($cpf){
		$this->cpf = $cpf;
	}
    function setNasc($nasc) {
      $this->nasc = $nasc;
    }
    function setObs($obs){
      $this->obs = $obs;
    }
    
  }
?>