<?php

    include_once("../conexao.php");
    include_once("../Classes/classeFuncionario.php");
    
    class FuncionarioSQL {
		var $sql;
	  
		function inserir($funcionario){
			$this->sql = "insert into pessoa (documento, nome, rua, numero, bairro, cidade, cep, fone) values(
			'".$funcionario->getCPF()."',
			'".$funcionario->getNome()."',
			'".$funcionario->getRua()."',      
			'".$funcionario->getNumero()."',
			'".$funcionario->getBairro()."',
			'".$funcionario->getCidade()."',
			'".$funcionario->getCEP()."',
			'".$funcionario->getFone()."'
			)";
			$ok = mysql_query($this->sql);
			if ($ok == true){
				$this->sql = "insert into fisica values (
				'".$funcionario->getCPF()."',
				'".$funcionario->getRG()."',
				'".$funcionario->getSexo()."',
				'".$funcionario->getMail()."',
				'".$funcionario->getSenha()."',
				'".$funcionario->getPermissao()."'
				)";
				mysql_query($this->sql);
				$this->sql = "insert into funcionario values (
				'".$funcionario->getCPF()."',
				'".$funcionario->getEntrada()."',
				'".$funcionario->getSaida()."',
				'".$funcionario->getComissao()."',
				'".$funcionario->getSalario()."',
				'".$funcionario->getFuncao()."'
				)";
				return mysql_query($this->sql);
			}
		}
	  
		function listar($cpf) {
			$this->sql = "select * from funcionario c, fisica f, pessoa p  
					where c.cpf = '$cpf' and p.documento = f.cpf and p.documento = c.cpf";
			$query = mysql_query($this->sql);
			$linha = mysql_fetch_array($query);
			if (empty($linha)) {
				return false;
			} else {
				$funcionario = new Funcionario();
				$funcionario->setNome($linha["nome"]);
				$funcionario->setRua($linha["rua"]);
				$funcionario->setNumero($linha["numero"]);
				$funcionario->setBairro($linha["bairro"]);
				$funcionario->setCidade($linha["cidade"]);
				$funcionario->setCEP($linha["cep"]);
				$funcionario->setFone($linha["fone"]);
				$funcionario->setCPF($linha["cpf"]);
				$funcionario->setRG($linha["rg"]);
				$funcionario->setSexo($linha["sexo"]);
				$funcionario->setMail($linha["mail"]);
				$funcionario->setSenha($linha["senha"]);
				$funcionario->setFuncao($linha["funcao"]);
				$funcionario->setPermissao($linha["permissao"]);
				$funcionario->setEntrada($linha["entrada"]);
				$funcionario->setSaida($linha["saida"]);
				$funcionario->setComissao($linha["comissao"]);
				$funcionario->setSalario($linha["salario"]);
				return $funcionario;
			}
		}
		
		function listarMail($mail) {
			$this->sql = "select * from funcionario c, fisica f, pessoa p
			where f.mail = '$mail' and p.documento = f.cpf and p.documento = c.cpf";
			$query = mysql_query($this->sql);
			$linha = mysql_fetch_array($query);
			if (empty($linha)) {
				return false;
			} else {
				$funcionario = new Funcionario();
				$funcionario->setNome($linha["nome"]);
				$funcionario->setRua($linha["rua"]);
				$funcionario->setNumero($linha["numero"]);
				$funcionario->setBairro($linha["bairro"]);
				$funcionario->setCidade($linha["cidade"]);
				$funcionario->setCEP($linha["cep"]);
				$funcionario->setFone($linha["fone"]);
				$funcionario->setCPF($linha["cpf"]);
				$funcionario->setRG($linha["rg"]);
				$funcionario->setSexo($linha["sexo"]);
				$funcionario->setMail($linha["mail"]);
				$funcionario->setSenha($linha["senha"]);
				$funcionario->setFuncao($linha["funcao"]);
				$funcionario->setPermissao($linha["permissao"]);
				$funcionario->setEntrada($linha["entrada"]);
				$funcionario->setSaida($linha["saida"]);
				$funcionario->setComissao($linha["comissao"]);
				$funcionario->setSalario($linha["salario"]);
				return $funcionario;
			}
		}
	  
		function listarTodos(){
			$this->sql = "select * from funcionario fu, fisica fi, pessoa p  
							where p.documento = fu.cpf and p.documento = fi.cpf
							order by p.nome";
			$query = mysql_query($this->sql);
			$funcionarioArr = array();
			while ($linha=mysql_fetch_array($query)){
				$funcionario = new funcionario();
				$funcionario->setNome($linha["nome"]);
				$funcionario->setRua($linha["rua"]);
				$funcionario->setNumero($linha["numero"]);
				$funcionario->setBairro($linha["bairro"]);
				$funcionario->setCidade($linha["cidade"]);
				$funcionario->setCEP($linha["cep"]);
				$funcionario->setCPF($linha["cpf"]);
				$funcionario->setSexo($linha["sexo"]);
				$funcionario->setMail($linha["mail"]);
				$funcionario->setSenha($linha["senha"]);
				$funcionario->setPermissao($linha["permissao"]);
				$funcionario->setEntrada($linha["entrada"]);
				$funcionario->setSaida($linha["saida"]);
				$funcionario->setComissao($linha["comissao"]);
				$funcionario->setSalario($linha["salario"]);
				$funcionarioArr[] = $funcionario;
				unset($funcionario);
			}
			return $funcionarioArr;
		}     
		
		function alterar($funcionario) {
			$this->sql = "update pessoa set
			documento = '".$funcionario->getCPF()."',
			nome = '".$funcionario->getNome()."',
			rua = '".$funcionario->getRua()."',      
			numero = '".$funcionario->getNumero()."',
			bairro = '".$funcionario->getBairro()."',
			cidade = '".$funcionario->getCidade()."',
			cep = '".$funcionario->getCEP()."',
			fone = '".$funcionario->getFone()."'
			where documento = '".$funcionario->getCPF()."'";
			$ok = mysql_query($this->sql);
			if ($ok == true){
				$this->sql = "update fisica set 
				cpf = '".$funcionario->getCPF()."',
				rg = '".$funcionario->getRG()."',
				sexo = '".$funcionario->getSexo()."',
				mail = '".$funcionario->getMail()."'
				where cpf = '".$funcionario->getCPF()."'";
				mysql_query($this->sql);
				$this->sql = "update funcionario set  
				cpf = '".$funcionario->getCPF()."',
				entrada = '".$funcionario->getEntrada()."',
				saida = '".$funcionario->getSaida()."',
				comissao = '".$funcionario->getComissao()."',
				salario = '".$funcionario->getSalario()."',
				funcao = '".$funcionario->getFuncao()."'
				where cpf = '".$funcionario->getCPF()."'";
				return mysql_query($this->sql);
			}
		}

    }

?>