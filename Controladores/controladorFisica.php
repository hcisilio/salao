<?php
	session_start();
	include_once("../ClassesSQL/classeFisicaSQL.php");
	
	class ControladorFisica {

		function login() {
			$mail = $_REQUEST["mail"];
			$senha = md5($_REQUEST["senha"]);      
			$persistir = new FisicaSQL();
			$lista = $persistir->login($mail, $senha);
			$cpf = $lista->getCPF();
			if(!empty($cpf)){
				$_SESSION["logado"] = 'true';
				$_SESSION["cpf"] = $cpf;
				$_SESSION["nome"] = $lista->getNome();
				$_SESSION["mail"] = $lista->getMail();
				$_SESSION["senha"] = $lista->getSenha();
				$_SESSION["permissao"] = $lista->getPermissao();
				$link = $_SESSION["permissao"];
				header("Location: ../GUIs/index$link.php");
			}	
			else {
				$_SESSION["erro"] = 1;
				header("Location: ../GUIs/login.php");
			}	
		}
		
		function AlterarPermissao(){
			$funcionario = $_REQUEST["funcionario"];
			$permissao = $_REQUEST["permissao"];
			$persistir = new FisicaSQL();
			$ok = $persistir->AlterarPermissao($funcionario, $permissao);
			if ($ok == true){
				$_SESSION["msg"] = "Permissão do funcionário alterada para ".$_REQUEST["permissao"]." com sucesso.";
				header("location: ../GUIs/saidas/sucesso.php");
			}
			else{
				$_SESSION["msg"] = "Ops! Falha ao registrar.";
				$_SESSION["erro"] = "Erro não identificado";
				header("location: ../GUIs/saidas/erro.php");
			}
		}
		
		function alterarSenha(){
			$cpf = $_SESSION["cpf"];
			$atual = md5($_REQUEST["atual"]);
			$nova = md5($_REQUEST["nova"]);
			$confirmNova = md5($_REQUEST["confirmNova"]);
			if ($atual == $_SESSION["senha"]) {
				$persistir = new FisicaSQL();
				$ok = $persistir->AlterarSenha($cpf, $atual, $nova, $confirmNova);
			}
			if ($ok == true){
				$_SESSION["senha"] = $nova;
				$_SESSION["msg"] = "Senha alterada com sucesso";
				header("location: ../GUIs/saidas/sucesso.php");
			}
			else{
				$_SESSION["msg"] = "Ops! Falha ao altear a senha.";
				$_SESSION["erro"] = "Senha atual incorreta.";
				header("location: ../GUIs/saidas/erro.php");
			}
		}
		
		function restaurarSenha(){
			$funcionario = $_REQUEST["funcionario"];
			$persistir = new FisicaSQL();
			$ok = $persistir->restaurarSenha($funcionario);
			if ($ok == true){
				$_SESSION["msg"] = "Senha restaurada com sucesso. A Senha padrão é <font color='red'> 1234 </font>";
				header("location: ../GUIs/saidas/sucesso.php");
			}
			else{
				$_SESSION["msg"] = "Ops! Falha ao restaurar a senha.";
				$_SESSION["erro"] = "Erro desconhecido.";
				header("location: ../GUIs/saidas/erro.php");
			}
		}

		function logout(){
			$_SESSION['logado'] = 'false';
			session_destroy();
			header("Location: ../GUIs/login.php");
		}

	}
?>
