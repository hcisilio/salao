<?php
	//session_start();
	include_once("../conexao.php");
	include_once("../Classes/classeAtendimento.php");
	include_once("classeClienteSQL.php");
	include_once("classeFuncionarioSQL.php");
	
	class AtendimentoSQL {
		
		var $sql;
		
		function inserir($atendimento){
			$this->sql = "insert into atendimento (cliente, data, funcionario, pagamento) values(
			'".$atendimento->getCliente()->getCPF()."',
			'".$atendimento->getData()."',
			'".$atendimento->getFuncionario()->getCPF()."',
			'".$atendimento->getPagamento()."'
			)";
			mysql_query($this->sql);
			return mysql_insert_id();
		}
		
		function listar($id){
			$this->sql = "select * from atendimento a, funcionario fu, cliente c, fisica fi, pessoa p where
						a.id=$id and p.documento = fi.cpf and p.documento = c.cpf and c.cpf = fi.cpf and p.documento = a.cliente and a.funcionario = fu.cpf";
			$query = mysql_query($this->sql);
			$linha=mysql_fetch_array($query);
			$atendimento = new Atendimento();
			$cliente = new ClienteSQL();
			$funcionario = new FuncionarioSQL();
			$atendimento = new atendimento();
			$atendimento->setId($linha["id"]);
			$atendimento->setCliente($cliente->listarCPF($linha["cliente"]));
			$atendimento->setData($linha["data"]);
			$atendimento->setFuncionario($funcionario->listar($linha["funcionario"]));
			$atendimento->setPagamento($linha["pagamento"]);
			return $atendimento;			
		}
		
		function listarCaixa($mes, $ano){
			$this->sql = "select * from atendimento a, funcionario fu, cliente c, fisica fi, pessoa p where
						month(a.data)=$mes and year(a.data)=$ano and p.documento = fi.cpf and p.documento = c.cpf and c.cpf = fi.cpf and p.documento = a.cliente and a.funcionario = fu.cpf";
			$query = mysql_query($this->sql);
			$atendimentoArr = array();
			while ($linha=mysql_fetch_array($query)){
				$cliente = new ClienteSQL();
				$funcionario = new FuncionarioSQL();
				$atendimento = new atendimento();
				$atendimento->setId($linha["id"]);
				$atendimento->setCliente($cliente->listarCPF($linha["cliente"]));
				$atendimento->setData($linha["data"]);
				$atendimento->setFuncionario($funcionario->listar($linha["funcionario"]));
				$atendimentoArr[] = $atendimento;
				unset($atendimento);
			}
			return $atendimentoArr;
		}
		
		function listarCaixaFuncionario($mes, $ano, $funcionario){
			$this->sql = "select * from atendimento a, funcionario fu, cliente c, fisica fi, pessoa p where
						month(a.data)=$mes and year(a.data)=$ano and a.funcionario='$funcionario' and p.documento = fi.cpf and p.documento = c.cpf and c.cpf = fi.cpf and p.documento = a.cliente and a.funcionario = fu.cpf";
			$query = mysql_query($this->sql);
			$atendimentoArr = array();
			while ($linha=mysql_fetch_array($query)){
				$cliente = new ClienteSQL();
				$funcionario = new FuncionarioSQL();
				$atendimento = new atendimento();
				$atendimento->setId($linha["id"]);
				$atendimento->setCliente($cliente->listarCPF($linha["cliente"]));
				$atendimento->setData($linha["data"]);
				$atendimento->setFuncionario($funcionario->listar($linha["funcionario"]));
				$atendimentoArr[] = $atendimento;
				unset($atendimento);
			}
			return $atendimentoArr;
		}
		
		function valorAtendimento($atendimento){
			$this->sql = "select sum(preco) from atendimento_servico where atendimento = $atendimento";
			$query = mysql_query($this->sql);
			$linha = mysql_fetch_array($query);
			return $linha["sum(preco)"];
		}
	
	}
?>
