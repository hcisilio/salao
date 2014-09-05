<?php
	session_start();
	include_once("../ClassesSQL/classeClienteSQL.php");
	class ControladorCliente {
    
		function inserir() {
			$cliente = new Cliente();
			$cliente->setNome($_REQUEST["nome"]);
			$cliente->setFone($_REQUEST["fone"]);
			$cliente->setRua($_REQUEST["rua"]);
			$cliente->setNumero($_REQUEST["numero"]);
			$cliente->setBairro($_REQUEST["bairro"]);
			$cliente->setCidade($_REQUEST["cidade"]);
			$cliente->setCEP($_REQUEST["cep"]);
			$cliente->setCPF($_REQUEST["cpf"]);
			$cliente->setRG($_REQUEST["rg"]);
			$cliente->setSexo($_REQUEST["sexo"]);
			$cliente->setNasc($_REQUEST["ano"]."-".$_REQUEST["mes"]."-".$_REQUEST["dia"]);
			$cliente->setObs($_REQUEST["obs"]);
			$cliente->setMail($_REQUEST["mail"]);
			$cliente->setSenha(md5("1234"));
			$cliente->setPermissao("Cliente");
			$persistir = new ClienteSQL();
			$ok = $persistir->listarMail($_REQUEST["mail"]);
			if ($ok == false){
				$ok = $persistir->inserir($cliente);
				if ($ok == true){
					$_SESSION["msg"] = "Cliente registrado com sucesso.";
					header("location: ../GUIs/saidas/sucesso.php");
				}
				else{
					$_SESSION["msg"] = "Ops! Cliente não cadastrado.";
					$_SESSION["erro"] = "CPF ". $_REQUEST["cpf"] ." já está registrado no sistema.";
					header("location: ../GUIs/saidas/erro.php");
				}
			} 
			else {
				$_SESSION["msg"] = "Ops! Cliente não cadastrado.";
				$_SESSION["erro"] = "E-mail ". $_REQUEST["mail"] ." já está registrado no sistema.";
				header("location: ../GUIs/saidas/erro.php");
			}
		}
    
	    function prepararAlteracao() {
			$q = $_REQUEST["q"];
			$persistir = new ClienteSQL();
			$cliente = $persistir->listarCPF($q);			
			if ($cliente == false){
				$txt = " <div id='toal'> </div> 
						<div id='formDireita'> Não foi localizado cliente para o CPF informado</div>";
				echo $txt;
			} else {
				$nome = $cliente->getNome();
				$rua = $cliente->getRua();
				$numero = $cliente->getNumero();
				$bairro = $cliente->getBairro();
				$cidade = $cliente->getCidade();
				$cep = $cliente->getCEP();;
				$fone = $cliente->getFone();
				$cpf = $cliente->getCPF();
				$rg = $cliente->getRG();
				$sexo = $cliente->getSexo();
				if ($sexo == "Masculino"){
					$M = "selected";
					$F = "";
				}
				else {
					$M = "";
					$F = "selected";
				}
				$mail = $cliente->getMail();			
				$nasc = explode("-", $cliente->getNasc());
				$dia = $nasc["2"];
				$mes = $nasc["1"];
				$ano = $nasc["0"];
				$obs = $cliente->getObs();
				$txt = "
				<form action='../Controladores/controlador.php' name='cliente' method='post' onSubmit='JavaScript:return validar()'>
				<ul id='menu'> 
					<li><input type='submit' value='Atualizar' class='linkSubmit'> </li>	
				</ul>
				<div id='formDireita'>				
						<input type='hidden' name='classe' value='Cliente'>
						<input type='hidden' name='metodo' value='alterar'>
						<label for='nome'>Nome Completo: </label><BR/ > <input type='text' id='nome' name='nome' size='30' value='$nome'/> <BR /> 
						<label for='rua'>Rua: </label><BR/ ><input type='text' id='rua' name='rua' size='30' value='$rua'/>  <BR />
						<label for='numero'>Número: </label><BR/ ><input type='text' id='numero' name='numero' size='30' value='$numero'/> <BR /> 
						<label for='bairro'>Bairro: </label><BR/ ><input type='text' id='bairro' name='bairro' size='30' value='$bairro'/> <BR />
						<label for='cidade'>Cidade: </label><BR/ ><input type='text' id='cidade' name='cidade' size='30' value='$cidade'/> <BR />
						<label for='cep'>CEP: </label><BR/ ><input type='text' id='cep' name='cep' size='30' value='$cep' onKeyUp='javascript:maskCEP(this.value)' />  <BR />
						<label for='fone'>Telefone: </label><BR/ ><input type='text' id='fone' name='fone' size='30' value='$fone' onKeyUp='javascript:maskFone(this.value)'/> <BR />
						<label for='cpf'>CPF: </label><BR/ ><input type='text' name='cpf' size='30' maxlength='14' value='$cpf' onKeyUp='javascript:maskCPF(this.value)' readonly/> <BR />					
						<label for='rg'>RG: </label><BR/ ><input type='text' id='rg' name='rg' size='30' value='$rg'/> <BR />
						<label for='sexo'>Sexo </label><BR/ >
										<select name='sexo' id='sexo'>
												<option value='Masculino' $M> Masculino </option>
												<option value='Feminino' $F> Feminino </option>
											</select>  <BR />
						<label for='dia'>Data de Nascimento: </label><BR/ ><input type='text' id='dia' name='dia' size='2' maxlength='2' value='$dia'/>/<input type='text' id='mes' name='mes' size='2' maxlength='2' value='$mes'>/<input type='text' id='ano' name='ano' size='4' maxlength='4' value='$ano'> <BR />
						<label for='mail'>E-mail: </label><BR/ ><input type='text' id='mail' name='mail' size='30' value='$mail'/> <BR />
						<label for='obs'>Observações:</label><BR/ > <textarea name='obs' id='obs' cols='50' rows='5'>$obs</textarea> <BR />
					</form>	
				</div>
				";
				echo $txt;
			}
	    }
	    
	    function listarTodos() {
	    }
	    
	    function alterar() {
			$cliente = new Cliente();
			$cliente->setNome($_REQUEST["nome"]);
			$cliente->setFone($_REQUEST["fone"]);
			$cliente->setRua($_REQUEST["rua"]);
			$cliente->setNumero($_REQUEST["numero"]);
			$cliente->setBairro($_REQUEST["bairro"]);
			$cliente->setCidade($_REQUEST["cidade"]);
			$cliente->setCEP($_REQUEST["cep"]);
			$cliente->setCPF($_REQUEST["cpf"]);
			$cliente->setRG($_REQUEST["rg"]);
			$cliente->setSexo($_REQUEST["sexo"]);
			$cliente->setNasc($_REQUEST["ano"]."-".$_REQUEST["mes"]."-".$_REQUEST["dia"]);
			$cliente->setObs($_REQUEST["obs"]);
			$cliente->setMail($_REQUEST["mail"]);
			$persistir = new ClienteSQL();
			$ok = $persistir->alterar($cliente);
			if ($ok == true){
				$_SESSION["msg"] = "Dados cadastrais alterados com sucesso.";
				header("location: ../GUIs/saidas/sucesso.php");
			}
			else{
				$_SESSION["msg"] = "Ops! Alteração não efetuada.";
				$_SESSION["erro"] = "Erro desconhecido.";
				header("location: ../GUIs/saidas/erro.php");
			}			
	    }
	    
	    function buscar(){
			$name = $_REQUEST["nome"];
			$persistir = new ClienteSQL();
			$clientes = $persistir->buscar($name);
			$total = count($clientes);
			if ($clientes == false){
				$_SESSION["msg"] = "Ops! Não foram localizados clientes com o nome informado.";
				header("location: ../GUIs/saidas/notFound.php");				
			}
			else { 
				for($i=0; $i<$total; $i++) {
					$cpf[] = $clientes[$i]->getCPF();
					$nome[] = $clientes[$i]->getNome();
					$mail[] = $clientes[$i]->getMail();
				}
				$_SESSION["total"] = $total;
				$_SESSION["cpfs"] = $cpf;
				$_SESSION["nomes"] = $nome;
				$_SESSION["mails"] = $mail;
				header("location: ../GUIs/saidas/listarClientes.php");
			}
		}   
  }
?>
