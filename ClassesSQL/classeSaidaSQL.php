<?php
	include_once("../conexao.php");
  	include_once("../Classes/classeSaida.php");
	include_once("classeEstoqueSQL.php");
	
	class SaidaSQL {
	
		var $sql;
		
		function inserir($saida){
			$this->sql = "insert into saida values(
			'".$saida->getProduto()->getId()."',
			'".$saida->getAtendimento()->getId()."',
			'".$saida->getQtd()."'			
			)";
			return mysql_query($this->sql);
		}
		
		function listarPorAtendimento($atendimento){
			$this->sql = "select * from saida s where s.atendimento = $atendimento";
			$query = mysql_query($this->sql);
			$saidaArr = array();
			while ($linha=mysql_fetch_array($query)){
				$estoque = new EstoqueSQL();
				$saida = new saida();
				$saida->setAtendimento($linha["atendimento"]);
				$saida->setProduto($estoque->listar($linha["produto"]));
				$saida->setQtd($linha["qtd"]);
				$saidaArr[] = $saida;
				unset($saida);
			}
			return $saidaArr;
		}
	
	}

?>	