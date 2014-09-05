<?php
	session_start();
	include_once("../ClassesSQL/classeFuncionarioSQL.php");
	
	class ControladorFuncionario {
	
		function inserir(){
			$funcionario = new Funcionario();
			$funcionario->setNome($_REQUEST["nome"]);
			$funcionario->setFone($_REQUEST["fone"]);
			$funcionario->setRua($_REQUEST["rua"]);
			$funcionario->setNumero($_REQUEST["numero"]);
			$funcionario->setBairro($_REQUEST["bairro"]);
			$funcionario->setCidade($_REQUEST["cidade"]);
			$funcionario->setCEP($_REQUEST["cep"]);
			$funcionario->setCPF($_REQUEST["cpf"]);
			$funcionario->setRG($_REQUEST["rg"]);
			$funcionario->setSexo($_REQUEST["sexo"]);
			$funcionario->setMail($_REQUEST["mail"]);
			$funcionario->setSenha(md5($_REQUEST["senha"]));
			$funcionario->setFuncao($_REQUEST["funcao"]);
			$funcionario->setEntrada($_REQUEST["entrada"]);
			$funcionario->setSaida($_REQUEST["saida"]);
			$funcionario->setComissao($_REQUEST["comissao"]);
			$funcionario->setSalario($_REQUEST["salario"]);
			$funcionario->setPermissao("Funcionario");
			$persistir = new FuncionarioSQL();
			$ok = $persistir->listarMail($_REQUEST["mail"]);
			if ($ok == false) {
				$ok = $persistir->inserir($funcionario);
				if ($ok == true){
					$_SESSION["msg"] = "Funcionário registrado com sucesso.";
					header("location: ../GUIs/saidas/sucesso.php");
				}
				else{
					$_SESSION["msg"] = "Ops! Funcionário não cadastrado.";
					$_SESSION["erro"] = "CPF ". $_REQUEST["cpf"] ." já está registrado no sistema.";
					header("location: ../GUIs/saidas/erro.php");
				}
			} else {
				$_SESSION["msg"] = "Ops! Funcionário não cadastrado.";
				$_SESSION["erro"] = "E-mail ". $_REQUEST["mail"] ." já está registrado no sistema.";
				header("location: ../GUIs/saidas/erro.php");
			}
		}
		
		function prepararAlteracao() {
			$q = $_REQUEST["q"];
			$persistir = new FuncionarioSQL();
			$funcionario = $persistir->listar($q);
			if (!$funcionario){
				$txt = " <div id='toal'> </div> 
						<div id='formDireita'> Não foi localizado funcionario para o CPF informado</div>";
				echo $txt;
			} else {
				$nome = $funcionario->getNome();
				$rua = $funcionario->getRua();
				$numero = $funcionario->getNumero();
				$bairro = $funcionario->getBairro();
				$cidade = $funcionario->getCidade();
				$cep = $funcionario->getCEP();;
				$fone = $funcionario->getFone();
				$cpf = $funcionario->getCPF();
				$rg = $funcionario->getRG();
				$sexo = $funcionario->getSexo();
				if ($sexo == "Masculino"){
					$M = "selected";
					$F = "";
				}
				else {
					$M = "";
					$F = "selected";
				}
				$mail = $funcionario->getMail();			
				$funcao = $funcionario->getFuncao();
				$entrada = $funcionario->getEntrada();
				$saida = $funcionario->getSaida();
				$salario = $funcionario->getSalario();
				$comissao = $funcionario->getComissao();
				$txt = "
				<form action='../Controladores/controlador.php' name='funcionario' method='post' onSubmit='JavaScript:return validar()'>
				<ul id='menu'> 
					<li><input type='submit' value='Atualizar' class='linkSubmit'> </li>	
				</ul>
				<div id='formDireita'>				
						<input type='hidden' name='classe' value='Funcionario'>
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
						<label for='mail'>E-mail: </label><BR/ ><input type='text' id='mail' name='mail' size='30' value='$mail'/> <BR />
						<label for='funcao'>Função: </label> <BR /> <input type='text' id= 'funcao' name='funcao' size='30' value='$funcao' /> <BR />
						<label for='entrada'>Entrada: </label> <BR /> <input type='text' id='entrada' name='entrada' size='30' value='$entrada' maxlength='5' OnKeyUp='mascara_entrada(this.value)' /> <BR />
						<label for='saida'>Saída </label> <BR /> <input type='text' id='saida' name='saida' size='30' maxlength='5' value='$saida' OnKeyUp='mascara_saida(this.value)'/> <BR />
						<label for='comissao'>Comissão: </label> <BR /> </td><td><input type='text' id='comissao' name='comissao' size='30' value='$comissao' /> <BR />
						<label for='salario'>Salário: </label> <BR /> <input type='text' id='salario' name='salario' size='30' value='$salario' /> <BR />
					</form>	
				</div>
				";
				echo $txt;
			}
		}
		
		function alterar() {
			$funcionario = new funcionario();
			$funcionario->setNome($_REQUEST["nome"]);
			$funcionario->setFone($_REQUEST["fone"]);
			$funcionario->setRua($_REQUEST["rua"]);
			$funcionario->setNumero($_REQUEST["numero"]);
			$funcionario->setBairro($_REQUEST["bairro"]);
			$funcionario->setCidade($_REQUEST["cidade"]);
			$funcionario->setCEP($_REQUEST["cep"]);
			$funcionario->setCPF($_REQUEST["cpf"]);
			$funcionario->setRG($_REQUEST["rg"]);
			$funcionario->setSexo($_REQUEST["sexo"]);			
			$funcionario->setMail($_REQUEST["mail"]);
			$funcionario->setFuncao($_REQUEST["funcao"]);
			$funcionario->setEntrada($_REQUEST["entrada"]);
			$funcionario->setSaida($_REQUEST["saida"]);
			$funcionario->setComissao($_REQUEST["comissao"]);
			$funcionario->setSalario($_REQUEST["salario"]);
			$persistir = new funcionarioSQL();
			$ok = $persistir->alterar($funcionario);
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

	}

?>
