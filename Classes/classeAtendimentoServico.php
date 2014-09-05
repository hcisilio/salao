<?php
	
	include_once("classeAtendimento.php");
	include_once("classeServico.php");

	class AtendimentoServico {
	
		var $atendimento;
		var $servico;
		var $desconto;
		var $preco;
		
		//métodos GET
		function getAtendimento(){
			return $this->atendimento;
		}
		function getServico(){
			return $this->servico;
		}
		function getDesconto() {
			return $this->desconto;
		}
		function getPreco(){
			return $this->preco;
		}
		
		//métodos SET
		function setAtendimento($atendimento){
			$this->atendimento = $atendimento;
		}
		function setServico($servico){
			$this->servico = $servico;
		}
		function setDesconto($desconto){
			$this->desconto = $desconto;
		}
		function setPreco($preco){
			$this->preco = $preco;
		}
	}
?>
