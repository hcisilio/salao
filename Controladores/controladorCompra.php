<?php
	session_start();
	include_once("../ClassesSQL/classeCompraSQL.php");	
	include_once("../ClassesSQL/classeEstoqueSQL.php");	
	include_once("../ClassesSQL/classeFornecedorSQL.php");
	
	class controladorCompra {
	
		function inserir(){
			$produto = new EstoqueSQL();
			$idProd = $produto->listar($_REQUEST["id"])->getId();
			$fornecedor = new FornecedorSQL();		
			if (empty($idProd)) {
					$_SESSION["msg"] = "Compra não cadastrada";
					$_SESSION["erro"] = "Código do produto informado não está registrado no sistema. Favor cadastrar o produto antes de realizar a compra";
					header("Location: ../GUIs/saidas/erro.php");
			}
			else {				
				$compra = new Compra();
				$persistir = new CompraSQL();
				$compra->setNotaFiscal($_REQUEST["nota"]);
				$compra->setFornecedor($fornecedor->listarCNPJ($_REQUEST["cnpj"]));
				$compra->setProduto($produto->listar($_REQUEST["id"]));
				$compra->setValor(str_replace(",", ".", $_REQUEST["preco"]));
				$compra->setQtd($_REQUEST["qtd"]);
				$compra->setData($_REQUEST["ano"]."-".$_REQUEST["mes"]."-".$_REQUEST["dia"]);
				$ok = $persistir->inserir($compra);
				if ($ok == true){
					$produto->atualizaEstoque($produto->listar($_REQUEST["id"]), $compra->getQtd($_REQUEST["qtd"]));
					$_SESSION["msg"] = "Compra registrada e estoque do produto atualizado";
					header("Location: ../GUIs/saidas/sucesso.php");
				}
				else {				
					$_SESSION["msg"] = "Compra não cadastrada";
					$_SESSION["erro"] = mysql_error();
					header("Location: ../GUIs/saidas/erro.php");
				}
			}
		}
		
		function alterar(){
		}
	
	}
?>