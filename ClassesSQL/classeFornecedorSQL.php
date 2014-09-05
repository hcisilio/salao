<?php
	include_once("../conexao.php");
	include_once("../Classes/classeFornecedor.php");
	
	class FornecedorSQL {
		var $sql;
		
		function inserir($fornecedor) {
			$this->sql = "insert into pessoa (documento, nome, rua, numero, bairro, cidade, cep, fone) values(
			'".$fornecedor->getCNPJ()."',
			'".$fornecedor->getNome()."',
			'".$fornecedor->getRua()."',      
			'".$fornecedor->getNumero()."',
			'".$fornecedor->getBairro()."',
			'".$fornecedor->getCidade()."',
			'".$fornecedor->getCEP()."',
			'".$fornecedor->getFone()."'
			)";
			$ok = mysql_query($this->sql);
			if ($ok == true){
				$this->sql = "insert into fornecedor values ( 
				'".$fornecedor->getCNPJ()."',
				'".$fornecedor->getMail()."'
				)";
				return mysql_query($this->sql);
			}
		}
		function buscar($nome){
			$this->sql = "select * from fornecedor f, pessoa p  
						  where p.nome like '$nome%' and p.documento = f.cnpj and p.documento <> 'root' 
						  order by p.nome";
			$query = mysql_query($this->sql);
			$fornecedorsArr = array();
			while ($linha = mysql_fetch_array($query)){
				$fornecedor = new Fornecedor();
				$fornecedor->setNome($linha["nome"]);
				$fornecedor->setRua($linha["rua"]);
				$fornecedor->setNumero($linha["numero"]);
				$fornecedor->setBairro($linha["bairro"]);
				$fornecedor->setCidade($linha["cidade"]);
				$fornecedor->setCEP($linha["cep"]);
				$fornecedor->setFone($linha["fone"]);
				$fornecedor->setCNPJ($linha["cnpj"]);
				$fornecedor->setMail($linha["mail"]);
				$fornecedorArr [] = $fornecedor;
				unset($fornecedor);
			}
			return $fornecedorArr;
		}
		
		function listarCNPJ($cnpj) {
			$this->sql = "select * from fornecedor f, pessoa p 
				where f.cnpj = '$cnpj' and p.documento = f.cnpj";
			$query = mysql_query($this->sql);
			$linha = mysql_fetch_array($query);
			if (empty($linha)) {
				return false;
			} else {
				$fornecedor = new Fornecedor();
				$fornecedor->setNome($linha["nome"]);
				$fornecedor->setRua($linha["rua"]);
				$fornecedor->setNumero($linha["numero"]);
				$fornecedor->setBairro($linha["bairro"]);
				$fornecedor->setCidade($linha["cidade"]);
				$fornecedor->setCEP($linha["cep"]);
				$fornecedor->setFone($linha["fone"]);
				$fornecedor->setCNPJ($linha["cnpj"]);
				$fornecedor->setMail($linha["mail"]);
				return $fornecedor;
			}
		}
		
		function alterar($fornecedor) {
			$this->sql = "update pessoa set
			documento = '".$fornecedor->getCNPJ()."',
			nome = '".$fornecedor->getNome()."',
			rua = '".$fornecedor->getRua()."',      
			numero = '".$fornecedor->getNumero()."',
			bairro = '".$fornecedor->getBairro()."',
			cidade = '".$fornecedor->getCidade()."',
			cep = '".$fornecedor->getCEP()."',
			fone = '".$fornecedor->getFone()."'
			where documento = '".$fornecedor->getCNPJ()."'";
			$ok = mysql_query($this->sql);
			if ($ok == true){
				$this->sql = "update fornecedor set  
				mail = '".$fornecedor->getMail()."'
				where cnpj = '".$fornecedor->getCNPJ()."'";
				return mysql_query($this->sql);
			}
		}
	}
?>