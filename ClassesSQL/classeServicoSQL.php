<?php

	include_once("../conexao.php");
  	include_once("../Classes/classeServico.php");
  	class ServicoSQL {
	
		var $sql;
	
		function inserir($servico) {
			$this->sql = "insert into servico (tipo, preco) values (
			'".$servico->getTipo()."',
			'".$servico->getPreco()."'
			)";
			mysql_query($this->sql);
      		$id = mysql_insert_id();
			return $id;
		}
		function alterar($servico) {
		}
		function listar($id) {
			$this->sql = "select * from servico 
						where id = '$id'";
			$query = mysql_query($this->sql);
			$linha = mysql_fetch_array($query);
			$servico = new Servico();
			$servico->setId($id);
			$servico->setTipo($linha["tipo"]);
			$servico->setPreco($linha["preco"]);
			return $servico;
		}
		function listarTodos() {
			$this->sql = "select * from servico order by tipo";
			$query = mysql_query($this->sql);
			$servicoArr = array();
			while ($linha=mysql_fetch_array($query)){
				$servico = new Servico();
				$servico->setId($linha["id"]);
				$servico->setTipo($linha["tipo"]);
				$servico->setPreco($linha["preco"]);
				$funcionarioArr[] = $servico;
				unset($servico);
			}
			return $funcionarioArr;
		}
	
	}

?>
