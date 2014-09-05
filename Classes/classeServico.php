<?php

	class Servico {
	
		var $id;
		var $tipo;
		var $preco;
		
		//metodos get:
		function getId(){
			return $this->id;
		}
		function getTipo() {
			return $this->tipo;
		}
		function getPreco() {
			return $this->preco;
		}
		
		//metodos set:
		function setId($id) {
			$this->id = $id;
		}
		function setTipo($tipo) {
			$this->tipo = $tipo;
		}
		function setPreco($preco) {
			$this->preco = $preco;
		}
	
	}

?>
