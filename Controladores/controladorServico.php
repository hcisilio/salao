<?php
	session_start();
	include_once("../ClassesSQL/classeServicoSQL.php");
	include_once("../Controladores/libs/Smarty.class.php");
	
	class ControladorServico {
	
		function inserir() {
			$servico = new Servico();
			$servico->setTipo($_REQUEST["tipo"]);
			$servico->setPreco(str_replace(",", ".", $_REQUEST["preco"]));
			$persistir = new ServicoSQL();
			$ok = $persistir->inserir($servico);
			if ($ok == true){
				$_SESSION["msg"] = "Serviço registrado com sucesso.";
				header("location: ../GUIs/saidas/sucesso.php");
			}
			else{
				$_SESSION["msg"] = "Ops! Serviço não cadastrado.";
				$_SESSION["erro"] = "Erro não identificado.";
				header("location: ../GUIs/saidas/erro.php");
			}
		}
		function alterar() {
		}
		function listar() {
		}
		function listarTodos() {
		}
	
	}


?>
