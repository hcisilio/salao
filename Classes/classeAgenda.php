<?php
class Agenda {

	var $servico;
	var $funcionario;
	var $cliente;
	var $data;
	var $hora;

	//metodos get:
	function getServico() {
		return $this->servico;
	}
	function getData() {
		return $this->data;
	}
	function getHora() {
		return $this->hora;
	}
	function getFuncionario() {
		return $this->funcionario;
	}
	function getCliente() {
		return $this->cliente;
	}

	//metodos set:
	function setServico($servico) {
		$this->servico = $servico;
	}
	function setData($data) {
		$this->data = $data;
	}
	function setHora($hora){
		$this->hora = $hora;
	}
	function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}
	function setCliente($cliente) {
		$this->cliente = $cliente;
	}

}
?>