<?php
	include_once("../conexao.php");
  	include_once("../Classes/classeEstoque.php");
	
	class EstoqueSQL {
	
		var $sql;
		
		function inserir($estoque){
			$this->sql = "insert into estoque values(
			'".$estoque->getId()."',
			'".$estoque->getDescricao()."',
			'".$estoque->getPreco_venda()."',
			'".$estoque->getQtd()."'
			)";
			return mysql_query($this->sql);
		}
		
		function listar($id){
			$this->sql = "select * from estoque where id = '$id'";
			$query = mysql_query($this->sql);
			$estoque = new Estoque();
			$linha=mysql_fetch_array($query);
			$estoque->setId($linha["id"]);
			$estoque->setDescricao($linha["descricao"]);
			$estoque->setPreco_venda($linha["preco_venda"]);
			$estoque->setQtd($linha["qtd"]);
			return $estoque;
		}
		
		function buscar($q){
			$this->sql = "select * from estoque where (id = '$q' or descricao like '$q%') and qtd > 0";
			$query = mysql_query($this->sql);
			$estoqueArr = array();
			while ($linha=mysql_fetch_array($query)){
				$estoque = new Estoque();
				$estoque->setId($linha["id"]);
				$estoque->setDescricao($linha["descricao"]);
				$estoque->setPreco_venda($linha["preco_venda"]);
				$estoque->setQtd($linha["qtd"]);
				$estoqueArr[] = $estoque;
				unset($estoque);
			}
			return $estoqueArr;
		}
		
		function listarAcabando() {
			$this->sql = "select * from estoque where qtd < 10 and qtd > 0";
			$query = mysql_query($this->sql);
			$estoqueArr = array();
			while ($linha=mysql_fetch_array($query)){
				$estoque = new Estoque();
				$estoque->setId($linha["id"]);
				$estoque->setDescricao($linha["descricao"]);
				$estoque->setPreco_venda($linha["preco_venda"]);
				$estoque->setQtd($linha["qtd"]);
				$estoqueArr[] = $estoque;
				unset($estoque);
			}
			return $estoqueArr;
		}
		
		function listarEmFalta(){
			$this->sql = "select * from estoque where qtd <= 0";
			$query = mysql_query($this->sql);
			$estoqueArr = array();
			while ($linha=mysql_fetch_array($query)){
				$estoque = new Estoque();
				$estoque->setId($linha["id"]);
				$estoque->setDescricao($linha["descricao"]);
				$estoque->setPreco_venda($linha["preco_venda"]);
				$estoque->setQtd($linha["qtd"]);
				$estoqueArr[] = $estoque;
				unset($estoque);
			}
			return $estoqueArr;
		}
		
		function atualizaEstoque($estoque, $qtd){				
			$this->sql = "update estoque set qtd = qtd+$qtd where id = '".$estoque->getId()."'";
			return mysql_query($this->sql);
		}
	}
?>