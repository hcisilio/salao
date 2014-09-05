<?php
	class Atendimento {
	
		var $id;
		var $cliente;
		var $data;
		var $funcionario;
		var $pagamento;
		
		//métodos GET
		function getId(){
			return $this->id;
		}
		function getCliente(){
			return $this->cliente;
		}
		function getData() {
			return $this->data;
		}
		function getFuncionario(){
			return $this->funcionario;
		}
		function getPagamento(){
			return $this->pagamento;
		}
		
		//métodos SET
		function setId($id){
			$this->id = $id;
		}
		function setCliente($cliente){
			$this->cliente = $cliente;
		}
		function setData($data){
			$this->data = $data;
		}
		function setFuncionario($funcionario){
			$this->funcionario = $funcionario;
		}
		function setPagamento($pagamento){
			$this->pagamento = $pagamento;
		}
	}
?>
