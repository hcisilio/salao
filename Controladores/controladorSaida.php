<?php
	session_start();
	include_once("../ClassesSQL/classeSaidaSQL.php");	
	include_once("../ClassesSQL/classeEstoqueSQL.php");	
	include_once("../ClassesSQL/classeAtendimentoSQL.php");
	
	class controladorSaida {
	
		function inserir(){			
			$produto = new EstoqueSQL();
			$atendimento = new AtendimentoSQL();
			$saida = new Saida();
			$saida->setProduto($produto->listar($_REQUEST["idProduto"]));
			$saida->setAtendimento($atendimento->listar($_REQUEST["idAtendimento"]));
			$saida->setQtd($_REQUEST["qtd"]);
			$persistir = new SaidaSQL();
			$ok = $persistir->inserir($saida);
			if ($ok == true){
				$qtd = $saida->getQtd($_REQUEST["qtd"]) - 2*$saida->getQtd($_REQUEST["qtd"]);
				$produto->atualizaEstoque($produto->listar($_REQUEST["idProduto"]), $qtd);
				$_SESSION["msg"] = "Saida registrada e estoque do produto atualizado";
				$_SESSION["pergunta"] = "Deseja registrar saída de outro produto para este atendimento?";
				$_SESSION["sim"] = "../registrarSaida.php";
				header("Location: ../GUIs/saidas/sucessoOpcao.php");
			}
			else {				
				$_SESSION["msg"] = "Saída de produto não cadastrada";
				$_SESSION["erro"] = mysql_error();
				header("Location: ../GUIs/saidas/erro.php");
			}			
		}
		
		function alterar(){
		}
	
	}
?>