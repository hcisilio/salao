<?php
	session_start();
	$permissao=$_SESSION["permissao"];
	if ( ($permissao == "Gerente") || ($permissao == "Administrador") ){
	}
	else {
		$_SESSION["msg"] = "Você não pode acessar esta página!";
		$_SESSION["erro"] = "Página requisitada só pode ser acessada por usuários com perfil \"Administrador\" ou \"Gerente\"  ";
		header("location: saidas/erro.php");
	}
?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
	<title>Registrar novo Funcionario</title>
	<script type="text/javascript" src="scripts/funcoes.js"></script>
	<script>
		function validar () {
			//nome nao pode ficar em branco
			if(document.funcionario.nome.value == ""){
				alert ("Campo nome em branco!");
				document.funcionario.nome.focus();
				return false;
			}
			//rua nao pode ficar em branco
			if(document.funcionario.rua.value == ""){
				alert ("Campo rua em branco!");
				document.funcionario.rua.focus();
				return false;
			}
			//numero nao pode ficar em branco e deve conter apenas caracteres numericos
			if ((document.funcionario.numero.value == "") || (isNaN(document.funcionario.numero.value))){
				alert ("Campo número inválido!");
				document.funcionario.numero.focus();
				return false;
			}
			//bairro nao pode ficar em branco
			if(document.funcionario.bairro.value == ""){
				alert ("Campo bairro em branco!");
				document.funcionario.bairro.focus();
				return false;
			}
			//cidade nao pode ficar em branco
			if(document.funcionario.cidade.value == ""){
				alert ("Campo cidade em branco!");
				document.funcionario.cidade.focus();
				return false;
			}
			//CEP não deve ficar em branco
			if (document.funcionario.cep.value == "") {
				alert("Campo CEP em branco!");
				document.funcionario.cep.focus();
				return false;
			}
			//validação do telefone
			if (document.funcionario.fone.value == "") {
				alert("Campo telefone em branco!");
				document.funcionario.fone.focus();
				return false;
			}
			//CPF deve ser númerico e não pode ficar em branco
			if (document.funcionario.cpf.value == ""){
				alert ("Campo cpf em branco!");
				document.funcionario.cpf.focus();
				return false;
			}
			//RG deve ser numérico e não pode ficar em branco
			if (document.funcionario.rg.value == ""){
				alert ("Campo rg em branco!");
				document.funcionario.rg.focus();
				return false;
			}
			//senha não pode ficar em branco
			if (document.funcionario.senha.value == "") {
				alert("Campo senha em branco!");
				document.funcionario.senha.focus();
				return false;
			}
			// verifica se e-mail é válido
			/*var txt = document.funcionario.mail.value;
			if ((txt.length != 0) && ((txt.indexOf("@") < 1) || (txt.indexOf('.') < 7))) {
				alert('Email incorreto');
				document.funcionario.mail.focus();
				return false;
			}*/
			//Função não pode ficar em branco
			if (document.funcionario.funcao.value == "") {
				alert("Campo função em branco!");
				document.funcionario.funcao.focus();
				return false;
			}
			//Verifica hora de entrada
			hrs = (document.funcionario.entrada.value.substring(0,2)); 
			min = (document.funcionario.entrada.value.substring(3,5)); 
            situacao = "";
            if ((hrs < 00 ) || (hrs > 23) || ( min < 00) ||( min > 59)){ 
                situacao = "falsa"; 
            }    
			if (isNaN(hrs)||isNaN(min)){
				situacao = "falsa";
			}               
            if (document.funcionario.entrada.value == "") { 
                situacao = "falsa"; 
            } 
            if (situacao == "falsa") { 
                alert("Hora inválida!"); 
                this.focus();
				return false;
            }
            //Verifica hora de saída
			hrs = (document.funcionario.saida.value.substring(0,2)); 
			min = (document.funcionario.saida.value.substring(3,5)); 
            situacao = "";
            if ((hrs < 00 ) || (hrs > 23) || ( min < 00) ||( min > 59)){ 
                situacao = "falsa"; 
            }    
			if (isNaN(hrs)||isNaN(min)){
				situacao = "falsa";
			}               
            if (document.funcionario.saida.value == "") { 
                situacao = "falsa"; 
            } 
            if (situacao == "falsa") { 
                alert("Hora inválida!"); 
                this.focus();
				return false;
            }
            //comissao deve ser numérico e não pode ficar em branco
			if ((document.funcionario.comissao.value == "") || (isNaN(document.funcionario.comissao.value))){
				alert ("Campo comissao inválido!");
				document.funcionario.comissao.focus();
				return false;
			}
			//salario deve ser numérico e não pode ficar em branco
			if ((document.funcionario.salario.value == "") || (isNaN(document.funcionario.salario.value))){
				alert ("Campo salario inválido!");
				document.funcionario.salario.focus();
				return false;
			}
			
		}
	</script>
	</head>
	<body>
		<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
		<div id="shadow">
			<form action="../Controladores/controlador.php" name="funcionario" method="post" onSubmit="JavaScript:return validar()">
				<input type="hidden" name="classe" value="Funcionario">
				<input type="hidden" name="metodo" value="inserir">
				<ul id="menu"> 
					<li><input type='submit' value='Registrar' class='linkSubmit'> </li>
					<li><a href="../GUIs/index<?php echo"$permissao";?>.php">Home</a></li>		
				</ul>
				<div id="formDireita">
					<label for="nome">Nome Completo:</label> <BR /> <input type="text" name="nome" size="30" /> <BR />
					<label for="rua">Rua: </label> <BR /> </td><td><input type="text" name="rua" size="30" /> <BR />
					<label for="numero">Número: </label> <BR /><input type="text" name="numero" size="30" />  <BR />
					<label for="cidade"> </label>Cidade: <BR /> <input type="text" name="cidade" size="30" /> <BR />
					<label for="bairro">Bairro: </label> <BR /> <input type="text" name="bairro" size="30" /> <BR />
					<label for="cep">CEP: </label> <BR /> <input type="text" name="cep" size="30" OnKeyUp="maskCEP(this.value)"/><BR />
					<label for="fone">Telefone: </label> <BR /> </td><td><input type="text" name="fone" size="30" OnKeyUp="maskFone(this.value)"/> <BR />
					<label for="cpf">CPF: </label> <BR /> <input type="text" name="cpf" size="30" maxlength="14" OnKeyUp="maskCPF(this.value)"/> <BR />
					<label for="rg">RG: </label> <BR /><input type="text" name="rg" size="30" /> <BR />
					<label for="sexo">Sexo </label> <BR /> 
					<select name="sexo">
                        <option value="Masculino"> Masculino </option>
                        <option value="Feminino"> Feminino </option>
                    </select> <BR />
					<label for="mail">E-mail: </label> <BR /> </td><td><input type="text" name="mail" size="30" /> <BR />
					<label for="senha">Senha: </label> <BR /> <input type="password" name="senha" size="30" /> <BR />
					<label for="funcao">Função: </label> <BR /> <input type="text" name="funcao" size="30" /> <BR />
					<label for="entrada">Entrada: </label> <BR /> <input type="text" name="entrada" size="30" maxlength="5" OnKeyUp="mascara_entrada(this.value)" /> <BR />
					<label for="saida">Saída </label> <BR /> <input type="text" name="saida" size="30" maxlength="5" OnKeyUp="mascara_saida(this.value)"/> <BR />
					<label for="comissao">Comissão: </label> <BR /> </td><td><input type="text" name="comissao" size="30" /> <BR />
					<label for="salario">Salário: </label> <BR /> <input type="text" name="salario" size="30" /> <BR />
				</div>
			</form>
		</div>
		
		<div class="clear"></div> 
		<div id="footer">
			<p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>	
	</body>        
</html>
