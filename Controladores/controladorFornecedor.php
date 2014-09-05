<?php
	session_start();	
	include_once("../ClassesSQL/classeFornecedorSQL.php");
	
	class ControladorFornecedor {
    
		function inserir() {
			$fornecedor = new Fornecedor();
			$fornecedor->setNome($_REQUEST["nome"]);
			$fornecedor->setFone($_REQUEST["fone"]);
			$fornecedor->setRua($_REQUEST["rua"]);
			$fornecedor->setNumero($_REQUEST["numero"]);
			$fornecedor->setBairro($_REQUEST["bairro"]);
			$fornecedor->setCidade($_REQUEST["cidade"]);
			$fornecedor->setCEP($_REQUEST["cep"]);
			$fornecedor->setCNPJ($_REQUEST["cnpj"]);
			$fornecedor->setMail($_REQUEST["mail"]);
			$persistir = new FornecedorSQL();
			$ok = $persistir->inserir($fornecedor);
			if ($ok == true){
				$_SESSION["msg"] = "Fornecedor cadastrado no sistema";
				header("Location: ../GUIs/saidas/sucesso.php");
			}
			else{
				$_SESSION["msg"] = "Fornecedor não cadastrado";
				$_SESSION["erro"] = mysql_error();
				header("Location: ../GUIs/saidas/erro.php");
			}
		}
		
		function buscar(){
			$name = $_REQUEST["nome"];
			$persistir = new FornecedorSQL();
			$fornecedores = $persistir->buscar($name);
			$total = count($persistir->buscar($name));
			if (!empty($fornecedores)){				
				for($i=0; $i<$total; $i++) {
					$cnpjs[] = $fornecedores[$i]->getCNPJ();
					$nomes[] = $fornecedores[$i]->getNome();
				}
				$_SESSION["total"] = $total;
				$_SESSION["cnpjs"] = $cnpjs;
				$_SESSION["nomes"] = $nomes;
				header("Location: ../GUIs/saidas/listarFornecedores.php");				
			}
			else { 
				$_SESSION["msg"] = "Fornecedor não encontrado no sistema";
				header("Location: ../GUIs/saidas/erro.php");
			}
		}
		
		function prepararAlteracao() {
			$q = $_REQUEST["q"];
			$persistir = new fornecedorSQL();
			$fornecedor = $persistir->listarCNPJ($q);
			//$total = count($persistir->listarCPF($q));			
			if (!$fornecedor){
				$txt = " <div id='toal'> </div> 
						<div id='formDireita'> Não foi localizado fornecedor para o CNPJ informado</div>";
				echo $txt;
			} else {
				$nome = $fornecedor->getNome();
				$rua = $fornecedor->getRua();
				$numero = $fornecedor->getNumero();
				$bairro = $fornecedor->getBairro();
				$cidade = $fornecedor->getCidade();
				$cep = $fornecedor->getCEP();;
				$fone = $fornecedor->getFone();
				$cnpj = $fornecedor->getCNPJ();
				$mail = $fornecedor->getMail();				
				$txt = "
				<form action='../Controladores/controlador.php' name='fornecedor' method='post' onSubmit='JavaScript:return validar()'>
				<ul id='menu'> 
					<li><input type='submit' value='Atualizar' class='linkSubmit'> </li>	
				</ul>
				<div id='formDireita'>				
						<input type='hidden' name='classe' value='Fornecedor'>
						<input type='hidden' name='metodo' value='alterar'>
						<input type='hidden' name='cnpj' size='30' value='$cnpj' />			
						<label for='nome'>Nome da Empresa: </label><BR/ > <input type='text' id='nome' name='nome' size='30' value='$nome'/> <BR /> 
						<label for='rua'>Rua: </label><BR/ ><input type='text' id='rua' name='rua' size='30' value='$rua'/>  <BR />
						<label for='numero'>Número: </label><BR/ ><input type='text' id='numero' name='numero' size='30' value='$numero' /> <BR /> 
						<label for='bairro'>Bairro: </label><BR/ ><input type='text' id='bairro' name='bairro' size='30' value='$bairro' /> <BR />
						<label for='cidade'>Cidade: </label><BR/ ><input type='text' id='cidade' name='cidade' size='30' value='$cidade' /> <BR />
						<label for='cep'>CEP: </label><BR/ ><input type='text' id='cep' name='cep' size='30' value='$cep' onKeyUp='javascript:maskCEP(this.value)' />  <BR />
						<label for='fone'>Telefone: </label><BR/ ><input type='text' id='fone' name='fone' size='30' value='$fone' onKeyUp='javascript:maskFone(this.value)'/> <BR />									
						<label for='mail'>E-mail: </label><BR/ ><input type='text' id='mail' name='mail' size='30' value='$mail' /> <BR />
					</form>	
				</div>
				";
				echo $txt;
			}
		}
		
		function alterar() {
			$fornecedor = new Fornecedor();
			$fornecedor->setNome($_REQUEST["nome"]);
			$fornecedor->setFone($_REQUEST["fone"]);
			$fornecedor->setRua($_REQUEST["rua"]);
			$fornecedor->setNumero($_REQUEST["numero"]);
			$fornecedor->setBairro($_REQUEST["bairro"]);
			$fornecedor->setCidade($_REQUEST["cidade"]);
			$fornecedor->setCEP($_REQUEST["cep"]);
			$fornecedor->setCNPJ($_REQUEST["cnpj"]);
			$fornecedor->setMail($_REQUEST["mail"]);
			$persistir = new fornecedorSQL();
			$ok = $persistir->alterar($fornecedor);
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