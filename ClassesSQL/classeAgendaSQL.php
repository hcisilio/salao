<?php
	include_once("../conexao.php");
	include_once("../Classes/classeAgenda.php");
	include_once("classeServicoSQL.php");
	include_once("classeFuncionarioSQL.php");
	include_once("classeClienteSQL.php");
	
	class AgendaSQL {
		var $sql;
		
		function inserir($agenda){
			$this->sql = "insert into agenda values(
			'".$agenda->getCliente()->getCPF()."',
			'".$agenda->getFuncionario()->getCPF()."',
			'".$agenda->getData()."',
			'".$agenda->getHora()."',
			'".$agenda->getServico()."'
			)";
			return mysql_query($this->sql);
		}
		
		function listar($cpf, $data){
			$this->sql = "select * from agenda
						where funcionario = '$cpf' and data = '$data'
						order by hora";
			$query = mysql_query($this->sql);			
			if (empty($query)){
				return false;
			}
			else {
				$agendaArr = array();
				while ($linha = mysql_fetch_array($query)) {
					$agenda = new Agenda();
					$cliente = new ClienteSQL();
					$agenda->setCliente($cliente->listarCPF($linha["cliente"]));
					$funcionario = new FuncionarioSQL();
					$agenda->setFuncionario($funcionario->listar($linha["funcionario"]));
					$agenda->setServico($linha["servico"]);
					$agenda->setData($linha["data"]);
					$agenda->setHora($linha["hora"]);
					$agendaArr[] = $agenda;
					unset($agenda);
				}
				return $agendaArr;
			}
		}
	

	}
?>
