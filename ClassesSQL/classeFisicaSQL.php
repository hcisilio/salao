<?php
    include_once("../conexao.php");
    include_once("../Classes/classeFuncionario.php");
    class FisicaSQL {
	
		function login($mail, $senha) {      
			$this->sql = "select * from fisica f, pessoa p  
					where f.mail = '$mail' and f.senha = '$senha' and p.documento = f.cpf";
			$query = mysql_query($this->sql);
			$linha = mysql_fetch_array($query);
			$fisica = new Funcionario();
			$fisica->setNome($linha["nome"]);
			$fisica->setRua($linha["rua"]);
			$fisica->setNumero($linha["numero"]);
			$fisica->setbairro($linha["bairro"]);
			$fisica->setCidade($linha["cidade"]);
			$fisica->setCEP($linha["cep"]);
			$fisica->setCPF($linha["cpf"]);
			$fisica->setSexo($linha["sexo"]);
			$fisica->setMail($linha["mail"]);
			$fisica->setSenha($linha["senha"]);
			$fisica->setPermissao($linha["permissao"]);
			return $fisica;
		}

		function alterarPermissao($funcionario, $permissao){
			$this->sql = "update fisica set permissao='$permissao' where cpf='$funcionario'";	
			return mysql_query($this->sql);
		}
		
		function alterarSenha($cpf, $atual, $nova, $confirmNova){
			$this->sql = "update fisica set senha='$nova' where cpf='$cpf'";	
			return mysql_query($this->sql);			
		}
		
		function restaurarSenha($funcionario){
			$this->sql = "update fisica set senha=md5('1234') where cpf='$funcionario'";	
			return mysql_query($this->sql);			
		}
	}
?>
