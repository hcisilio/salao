<?php
	session_start();
	include_once("../ClassesSQL/classeEstoqueSQL.php");	
	
	class controladorEstoque{		
		
		function inserir(){
			$estoque = new Estoque();
			$estoque->setId($_REQUEST["id"]);
			$estoque->setDescricao($_REQUEST["descricao"]);
			$estoque->setPreco_venda(str_replace(",", ".", $_REQUEST["preco"]));
			$estoque->setQtd($_REQUEST["qtd"]);
			$persistir = new EstoqueSQL();
			$ok = $persistir->inserir($estoque);
			if ($ok == true){
				$_SESSION["msg"] = "Produto cadastrado no estoque";
				header("Location: ../GUIs/saidas/sucesso.php");
			}
			else {				
				$_SESSION["msg"] = "Produto não cadastrado";
				$_SESSION["erro"] = mysql_error();
				header("Location: ../GUIs/saidas/erro.php");
			}
		}
		
		function buscar(){
			$q = $_REQUEST["q"];
			$persistir = new EstoqueSQL();
			$estoques = $persistir->buscar($q);
			$total = count($persistir->buscar($q));
			if (!empty($estoques)){
				for($i=0; $i<$total; $i++) {
					$id[] = $estoques[$i]->getId();
					$descricao[] = $estoques[$i]->getDescricao();
				}
				$_SESSION["total"] = $total;
				$_SESSION["ids"] = $id;
				$_SESSION["descricoes"] = $descricao;
				header("location: ../GUIs/saidas/listarEstoque.php");
			}
			else { 
				$_SESSION["msg"] = "Ops! Não foram localizados Produtos com o nome ou código de barras informado.";
				header("location: ../GUIs/saidas/notFound.php");
			}
		}
		
		function listarAcabando(){
			$persistir = new EstoqueSQL();
			$lista = $persistir->listarAcabando();
			return $lista;
		}
		
		function listarEmFalta(){
			$persistir = new EstoqueSQL();
			$lista = $persistir->listarEmFalta();
			return $lista;
		}
	
	}
	
?>