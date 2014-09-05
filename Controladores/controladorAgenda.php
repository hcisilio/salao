<?php
	session_start();	
	include_once("../ClassesSQL/classeAgendaSQL.php");
	include_once("../ClassesSQL/classeServicoSQL.php");
	include_once("../ClassesSQL/classeFuncionarioSQL.php");
	include_once("../ClassesSQL/classeClienteSQL.php");
	
	class ControladorAgenda {
		
		function inserir (){
			$cliente = new ClienteSQL();
			$funcionario = new FuncionarioSQL();
			$servico = new ServicoSQL();
			$agenda = new Agenda();
			$agenda->setCliente($cliente->listarCPF($_REQUEST["CPF"]));
			$agenda->setFuncionario($funcionario->listar($_REQUEST["funcionario"]));
			$agenda->setServico($_REQUEST["servico"]);
			$agenda->setData($_REQUEST["ano"]."-".$_REQUEST["mes"]."-".$_REQUEST["dia"]);
			$agenda->setHora($_REQUEST["hora"]);
			$persistir = new AgendaSQL();			
			$ok = $persistir->inserir($agenda);
			if ($ok == true){
				$_SESSION["msg"] = "Horário agendado com sucesso.";
				header("location: ../GUIs/saidas/sucesso.php");
			}
			else{
				$_SESSION["msg"] = "Ops! Agendamento não efetuado.";
				$_SESSION["erro"] = "O funcionário já possui cliente agendado no mesmo dia e horário";
				header("location: ../GUIs/saidas/erro.php");
			}
		}
		
		function minhaAgenda(){
			$funcionario = $_SESSION["cpf"];
			$data = $_REQUEST["ano"]."-".$_REQUEST["mes"]."-".$_REQUEST["dia"];
			$persistir = new AgendaSQL();			
			$agenda = $persistir->listar($funcionario, $data);
			$total = count($agenda);
			if ($agenda == false) {
				$_SESSION["msg"] = "Você não tem eventos agendados na data informada.";
				header("location: ../GUIs/saidas/notFound.php");
			} else {
				for($i=0; $i<$total; $i++){
					$clientes[] = $agenda[$i]->getCliente()->getNome();
					$horas[] = $agenda[$i]->getHora();
					$servicos[] = $agenda[$i]->getServico();
				}
				$_SESSION["funcionario"] = $agenda[0]->getFuncionario()->getNome();
				$_SESSION["data"] = $data;
				$_SESSION["total"] = $total;
				$_SESSION["clientes"] = $clientes;
				$_SESSION["horas"] = $horas;
				$_SESSION["servicos"] = $servicos;
				header("location: ../GUIs/saidas/listarAgenda.php");
			}
		}
		
		function agendaGeral(){
			$funcionario = $_REQUEST["funcionario"];
			$data = $_REQUEST["ano"]."-".$_REQUEST["mes"]."-".$_REQUEST["dia"];
			$persistir = new AgendaSQL();
			$agenda = $persistir->listar($funcionario, $data);
			$total = count($agenda);
			if ($agenda == false) {
				$_SESSION["msg"] = "O funcionário selecionado não possui eventos na data informada.";
				header("location: ../GUIs/saidas/notFound.php");
			} else {
				for($i=0; $i<$total; $i++){
					$clientes[] = $agenda[$i]->getCliente()->getNome();
					$horas[] = $agenda[$i]->getHora();
					$servicos[] = $agenda[$i]->getServico();
				}
				$_SESSION["funcionario"] = $agenda[0]->getFuncionario()->getNome();
				$_SESSION["data"] = $data;
				$_SESSION["total"] = $total;
				$_SESSION["clientes"] = $clientes;
				$_SESSION["horas"] = $horas;
				$_SESSION["servicos"] = $servicos;
				header("location: ../GUIs/saidas/listarAgenda.php");
			}
		}
	
	
	
	}

?>
