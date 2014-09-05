<?php
	session_start();
	include_once("../ClassesSQL/classeAtendimentoSQL.php");
	include_once("../ClassesSQL/classeClienteSQL.php");
	include_once("../ClassesSQL/classeFuncionarioSQL.php");
	include_once("../ClassesSQL/classeAtendimentoServicoSQL.php");
	include_once("../ClassesSQL/classeServicoSQL.php");
	
	class ControladorAtendimento {
		function inserir(){
			$idsServicos = $_REQUEST["servicos"];
			$cliente = new ClienteSQL();
			$funcionario = new FuncionarioSQL();
			$atendimento = new Atendimento();
			$atendimento->setCliente($cliente->listarCPF($_REQUEST["CPF"]));
			$atendimento->setData($_REQUEST["ano"]."-".$_REQUEST["mes"]."-".$_REQUEST["dia"]);
			$atendimento->setFuncionario($funcionario->listar($_REQUEST["funcionario"]));
			$atendimento->setPagamento($_REQUEST["pagamento"]);
			$persistir = new AtendimentoSQL();
			$lastId = $persistir->inserir($atendimento);
			if (!empty($lastId)) {
				$atendimento->setId($lastId);
				$servico = new ServicoSQL();
				foreach ($idsServicos as $i){
					$atendServ = new AtendimentoServico();
					$atendServ->setServico($servico->listar($i));
					$atendServ->setAtendimento($atendimento);
					$atendServ->setDesconto(0);
					$atendServ->setPreco($servico->listar($i)->getPreco());
					$persistir = new AtendimentoServicoSQL();
					$ok = $persistir->inserir($atendServ);
				}				
			}
			else {
				$ok = false;
			}
			if ($ok == true){
				$_SESSION["msg"] = "Atendimento registrado com sucesso.";
				$_SESSION["pergunta"] = "Deseja registrar a saída de algum produto?";
				$_SESSION["sim"] = "../registrarSaida.php";
				$_SESSION["id"] = $lastId;
				header("location: ../GUIs/saidas/sucessoOpcao.php");
			}
			else{
				$_SESSION["msg"] = "Ops! Falha ao registrar.";
				$_SESSION["erro"] = "Problemas no preenchimento do formulário.";
				header("location: ../GUIs/saidas/erro.php");
			}
		}
		
		function listarCaixa(){
			$caixa = 0;
			$mes = $_REQUEST["mes"];
			$ano = $_REQUEST["ano"];
			$persistir = new AtendimentoSQL();			
			$atendimento = $persistir->listarCaixa($mes, $ano);
			$total = count($persistir->listarCaixa($mes, $ano));
			if ($total == 0) {
				$_SESSION["msg"] = "Não foram localizados atendimentos para a data e funcionários informados";
				header("location: ../GUIs/saidas/notFound.php");
			} 
			else {
				for($i=0; $i<$total; $i++){
					$id[] = $atendimento[$i]->getId();
					$cliente[] = $atendimento[$i]->getCliente()->getNome();
					$data[] = $atendimento[$i]->getData();
					$funcionarios[] = $atendimento[$i]->getFuncionario()->getNome();
					$subTotal = $persistir->valorAtendimento($id[$i]);
					$valor[] = $subTotal;
					$caixa += $subTotal;
				}
				$_SESSION["titulo"] = "Total de caixa por Funcionário";
				$_SESSION["total"] = $total;
				$_SESSION["ids"] = $id;
				$_SESSION["funcionarios"] = $funcionarios;
				$_SESSION["datas"] = $data;
				$_SESSION["clientes"] = $cliente;
				$_SESSION["valores"] = $valor;
				$_SESSION["caixa"] = $caixa;
				header("location: ../GUIs/saidas/listarCaixa.php");
			}
		}		
		
		function listarCaixaFuncionario(){
			$caixa = 0;			
			$mes = $_REQUEST["mes"];
			$ano = $_REQUEST["ano"];			
			$funcionario = $_REQUEST["funcionario"];
			$persistir = new AtendimentoSQL();
			$atendimento = $persistir->listarCaixaFuncionario($mes, $ano, $funcionario);
			$total = count($persistir->listarCaixaFuncionario($mes, $ano, $funcionario));
			if ($total == 0) {
				$_SESSION["msg"] = "Não foram localizados atendimentos para a data e funcionários informados";
				header("location: ../GUIs/saidas/notFound.php");
			} 
			else {
				for($i=0; $i<$total; $i++){
					$id[] = $atendimento[$i]->getId();
					$cliente[] = $atendimento[$i]->getCliente()->getNome();
					$data[] = $atendimento[$i]->getData();
					$funcionarios[] = $atendimento[$i]->getFuncionario()->getNome();
					$subTotal = $persistir->valorAtendimento($id[$i]);
					$valor[] = $subTotal;
					$caixa = $caixa+$subTotal;
				}				
				$_SESSION["titulo"] = "Total de caixa por Funcionário";
				$_SESSION["total"] = $total;
				$_SESSION["ids"] = $id;
				$_SESSION["funcionarios"] = $funcionarios;
				$_SESSION["datas"] = $data;
				$_SESSION["clientes"] = $cliente;
				$_SESSION["valores"] = $valor;
				$_SESSION["caixa"] = $caixa;
				header("location: ../GUIs/saidas/listarCaixa.php");
			}
		}
	}
?>
