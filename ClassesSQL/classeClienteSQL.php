<?php
  include_once("../conexao.php");
  include_once("../Classes/classeCliente.php");
  class ClienteSQL {
    
    function inserir($cliente) {
      $this->sql = "insert into pessoa (documento, nome, rua, numero, bairro, cidade, cep, fone) values(
      '".$cliente->getCPF()."',
	  '".$cliente->getNome()."',
      '".$cliente->getRua()."',      
      '".$cliente->getNumero()."',
      '".$cliente->getBairro()."',
      '".$cliente->getCidade()."',
      '".$cliente->getCEP()."',
      '".$cliente->getFone()."'
      )";
      $ok = mysql_query($this->sql);
      if ($ok == true){
		$this->sql = "insert into fisica values ( 
		'".$cliente->getCPF()."',
		'".$cliente->getRG()."',
		'".$cliente->getSexo()."',
		'".$cliente->getMail()."',
		'".$cliente->getSenha()."',
		'".$cliente->getPermissao()."'
		)";
		mysql_query($this->sql);
		$this->sql = "insert into cliente values (  
		'".$cliente->getCPF()."',
		'".$cliente->getNasc()."',
		'".$cliente->getObs()."'
		)";
		return mysql_query($this->sql);
      }
    }
    
    function listarMail($mail) {
		$this->sql = "select * from cliente c, fisica f, pessoa p  
			where f.mail = '$mail' and p.documento = f.cpf and p.documento = c.cpf";
		$query = mysql_query($this->sql);
		$linha = mysql_fetch_array($query);
		if (empty($linha)) {
			return false;
		} else {
			$cliente = new Cliente();;
			$cliente->setNome($linha["nome"]);
			$cliente->setRua($linha["rua"]);
			$cliente->setNumero($linha["numero"]);
			$cliente->setBairro($linha["bairro"]);
			$cliente->setCidade($linha["cidade"]);
			$cliente->setCEP($linha["cep"]);
			$cliente->setFone($linha["fone"]);
			$cliente->setCPF($linha["cpf"]);
			$cliente->setSexo($linha["sexo"]);
			$cliente->setMail($linha["mail"]);
			$cliente->setSenha($linha["senha"]);
			$cliente->setPermissao($linha["permissao"]);
			$cliente->setNasc($linha["nasc"]);
			$cliente->setObs($linha["obs"]);
			return $cliente;
		}
    }
    function listarCPF($cpf) {
		$this->sql = "select * from cliente c, fisica f, pessoa p  
			where f.cpf = '$cpf' and p.documento = f.cpf and p.documento = c.cpf";
		$query = mysql_query($this->sql);	
		$linha = mysql_fetch_array($query);
		if (empty($linha)) {
			return false;
		} 
		else {			
			$cliente = new Cliente();
			$cliente->setNome($linha["nome"]);
			$cliente->setRua($linha["rua"]);
			$cliente->setNumero($linha["numero"]);
			$cliente->setBairro($linha["bairro"]);
			$cliente->setCidade($linha["cidade"]);
			$cliente->setCEP($linha["cep"]);
			$cliente->setFone($linha["fone"]);
			$cliente->setCPF($linha["cpf"]);
			$cliente->setRG($linha["rg"]);
			$cliente->setSexo($linha["sexo"]);
			$cliente->setMail($linha["mail"]);
			$cliente->setSenha($linha["senha"]);
			$cliente->setPermissao($linha["permissao"]);
			$cliente->setNasc($linha["nasc"]);
			$cliente->setObs($linha["obs"]);
			return $cliente;
		}
    }
    
    function listarTodos() {
    }
    
    function alterar($cliente) {
		$this->sql = "update pessoa set
		documento = '".$cliente->getCPF()."',
		nome = '".$cliente->getNome()."',
		rua = '".$cliente->getRua()."',      
		numero = '".$cliente->getNumero()."',
		bairro = '".$cliente->getBairro()."',
		cidade = '".$cliente->getCidade()."',
		cep = '".$cliente->getCEP()."',
		fone = '".$cliente->getFone()."'
		where documento = '".$cliente->getCPF()."'";
		$ok = mysql_query($this->sql);
		if ($ok == true){
			$this->sql = "update fisica set 
			cpf = '".$cliente->getCPF()."',
			rg = '".$cliente->getRG()."',
			sexo = '".$cliente->getSexo()."',
			mail = '".$cliente->getMail()."'
			where cpf = '".$cliente->getCPF()."'";
			mysql_query($this->sql);
			$this->sql = "update cliente set  
			cpf = '".$cliente->getCPF()."',
			nasc = '".$cliente->getNasc()."',
			obs = '".$cliente->getObs()."'
			where cpf = '".$cliente->getCPF()."'";
			return mysql_query($this->sql);
		}
    }
    
    function buscar($q){
		$this->sql = "select * from cliente c, fisica f, pessoa p  
			where (p.nome like '$q%' or p.documento = '$q' )and p.documento = f.cpf and p.documento = c.cpf and p.documento <> 'root'
			order by p.nome";
		$query = mysql_query($this->sql);
		if (empty($query)){
			return false;
		}
		else {
			$clientesArr = array();
			while ($linha = mysql_fetch_array($query)){
				$cliente = new Cliente();
				$cliente->setNome($linha["nome"]);
				$cliente->setRua($linha["rua"]);
				$cliente->setNumero($linha["numero"]);
				$cliente->setBairro($linha["bairro"]);
				$cliente->setCidade($linha["cidade"]);
				$cliente->setCEP($linha["cep"]);
				$cliente->setFone($linha["fone"]);
				$cliente->setCPF($linha["cpf"]);
				$cliente->setSexo($linha["sexo"]);
				$cliente->setMail($linha["mail"]);
				$cliente->setSenha($linha["senha"]);
				$cliente->setPermissao($linha["permissao"]);
				$cliente->setNasc($linha["nasc"]);
				$cliente->setObs($linha["obs"]);
				$clientesArr [] = $cliente;
				unset($cliente);
			}
			return $clientesArr;
		}
	}
     
  }
?>