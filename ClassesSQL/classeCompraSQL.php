<?php
	include_once("../conexao.php");
  	include_once("../Classes/classeCompra.php");
	
	class CompraSQL {
	
		var $sql;
		
		function inserir($compra){
			$this->sql = "insert into compras values(
			'".$compra->getNotaFiscal()."',
			'".$compra->getFornecedor()->getCNPJ()."',
			'".$compra->getProduto()->getId()."',
			'".$compra->getValor()."',
			'".$compra->getQtd()."',
			'".$compra->getData()."'
			)";
			return mysql_query($this->sql);
		}
	
	}

?>	