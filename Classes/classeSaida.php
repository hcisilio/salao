<?php
	class Saida {
	
		var $produto;
		var $atendimento;		
		var $qtd;
		
		function getProduto(){
			return $this->produto;
		}
		function getAtendimento(){
			return $this->atendimento;
		}
		function getQtd(){
			return $this->qtd;
		}
		
		function setProduto($produto){
			$this->produto = $produto;
		}
		function setAtendimento($atendimento){
			$this->atendimento = $atendimento;
		}
		function setQtd($qtd){
			$this->qtd = $qtd;
		}
	
	}
?>