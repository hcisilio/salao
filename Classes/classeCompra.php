<?php
	class Compra {
	
		var $notaFiscal;
		var $fornecedor;
		var $produto;
		var $valor;
		var $qtd;
		var $data;		
		
		//metodos get:
		function getNotaFiscal() {
			return $this->notaFiscal;
		}
		function getFornecedor() {
			return $this->fornecedor;
		}
		function getData() {
			return $this->data;
		}
		function getProduto() {
			return $this->produto;
		}
		function getValor() {
			return $this->valor;
		}
		function getQtd() {
			return $this->qtd;
		}
		
		//metodos set:
		function setNotaFiscal($notaFiscal) {
			$this->notaFiscal = $notaFiscal;
		}
		function setFornecedor($fornecedor) {
			$this->fornecedor = $fornecedor;
		}
		function setData($data) {
			$this->data = $data;
		}
		function setProduto($produto){
			$this->produto = $produto;
		}
		function setValor($valor){
			$this->valor = $valor;
		}
		function setQtd($qtd) {
			$this->qtd = $qtd;
		}

	}
?>