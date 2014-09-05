<?php
	class Estoque {
	
		var $id;
		var $descricao;
		var $preco_venda;
		var $qtd;
		
		function getId(){
			return $this->id;
		}
		function getDescricao(){
			return $this->descricao;
		}
		function getPreco_venda(){
			return $this->preco_venda;
		}
		function getQtd(){
			return $this->qtd;
		}
		
		function setId($id){
			$this->id = $id;
		}
		function setDescricao($descricao){
			$this->descricao = $descricao;
		}
		function setPreco_venda($preco_venda){
			$this->preco_venda = $preco_venda;
		}
		function setQtd($qtd){
			$this->qtd = $qtd;
		}
	
	}
?>