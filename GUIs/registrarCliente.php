<?php
	session_start();
	$permissao=$_SESSION["permissao"];
?>
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<head>
	<title>Registrar novo cliente</title>	
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
	<script type="text/javascript" src="scripts/funcoes.js"></script>
	<script>		
		function validar () {
			//nome nao pode ficar em branco
			if(document.cliente.nome.value == ""){
				alert ("Campo nome em branco!");
				document.cliente.nome.focus();
				return false;
			}
			//rua nao pode ficar em branco
			if(document.cliente.rua.value == ""){
				alert ("Campo rua em branco!");
				document.cliente.rua.focus();
				return false;
			}
			//numero nao pode ficar em branco e deve conter apenas caracteres numericos
			if ((document.cliente.numero.value == "") || (isNaN(document.cliente.numero.value))){
				alert ("Campo número inválido!");
				document.cliente.numero.focus();
				return false;
			}
			//bairro nao pode ficar em branco
			if(document.cliente.bairro.value == ""){
				alert ("Campo bairro em branco!");
				document.cliente.bairro.focus();
				return false;
			}
			//cidade nao pode ficar em branco
			if(document.cliente.cidade.value == ""){
				alert ("Campo cidade em branco!");
				document.cliente.cidade.focus();
				return false;
			}
			//CEP não deve ficar em branco
			if (document.cliente.cep.value == "") {
				alert("Campo CEP em branco!");
				document.cliente.cep.focus();
				return false;
			}
			//validação do telefone
			if (document.cliente.fone.value == "") {
				alert("Campo telefone em branco!");
				document.cliente.fone.focus();
				return false;
			}
			//CPF pode ficar em branco
			if (document.cliente.cpf.value == ""){
				alert ("Campo CPF em branco!");
				document.cliente.cpf.focus();
				return false;
			}
			//RG não pode ficar em branco
			if (document.cliente.rg.value == ""){
				alert ("Campo RG em branco!");
				document.cliente.rg.focus();
				return false;
			}			
			//validação da data
			dia = (document.cliente.dia.value); 
            mes = (document.cliente.mes.value); 
            ano = (document.cliente.ano.value); 
            situacao = ""; 
            // verifica o dia valido para cada mes 
            if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { 
                situacao = "falsa"; 
            } 
            // verifica se o mes e valido 
            if (mes < 01 || mes > 12 ) { 
                situacao = "falsa"; 
            } 
            // verifica se e ano bissexto 
            if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
                situacao = "falsa"; 
            } 
			// verifica se datas sao numericas
			if (( isNaN(dia))||( isNaN(mes))||( isNaN(ano))){
				situacao = "falsa";
			}
            if ((document.cliente.dia.value == "")||(document.cliente.mes.value == "")||(document.cliente.ano.value == "")) { 
                situacao = "falsa"; 
            } 
            if (situacao == "falsa") { 
                alert("Data invÃ¡lida!"); 
				return false; 
            }
            // verifica se e-mail é válido
			/*var txt = document.cliente.mail.value;
			if ((txt.length != 0) && ((txt.indexOf("@") < 1) || (txt.indexOf('.') < 7))) {
				alert('Email incorreto');
				document.cliente.mail.focus();
				return false;
			}*/

		}
	</script>
	</head>
	<body>
	<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
	<div id="shadow">
		<form action="../Controladores/controlador.php" name="cliente" method="post" onSubmit="JavaScript:return validar()">
			<input type="hidden" name="classe" value="Cliente">
			<input type="hidden" name="metodo" value="inserir">
			<ul id="menu"> 
				<li><input type='submit' value='Registrar' class='linkSubmit'> </li>
				<li><a href="../GUIs/index<?php echo"$permissao";?>.php">Home</a></li>		
			</ul>	
			<div id="formDireita">			
				<label for="nome">Nome Completo: </label><BR/ > <input type="text" name="nome" size="30" /> <BR /> 
				<label for="rua">Rua: </label><BR/ ><input type="text" name="rua" size="30" />  <BR />
				<label for="numero">Número: </label><BR/ ><input type="text" name="numero" size="30" /> <BR /> 
				<label for="bairro">Bairro: </label><BR/ ><input type="text" name="bairro" size="30" /> <BR />
				<label for="cidade">Cidade: </label><BR/ ><input type="text" name="cidade" size="30" /> <BR />
				<label for="cep">CEP: </label><BR/ ><input type="text" name="cep" size="30" onKeyUp="javascript:maskCEP(this.value)" />  <BR />
				<label for="fone">Telefone: </label><BR/ ><input type="text" name="fone" size="30" onKeyUp="javascript:maskFone(this.value)"/> <BR />
				<label for="cpf">CPF: </label><BR/ ><input type="text" name="cpf" size="30" maxlength="14" onKeyUp="javascript:maskCPF(this.value)" /> <BR />
				<label for="rg">RG: </label><BR/ ><input type="text" name="rg" size="30" /> <BR />
				<label for="sexo">Sexo </label><BR/ >
									<select name="sexo">
										<option value="Masculino"> Masculino </option>
										<option value="Feminino"> Feminino </option>
									</select>  <BR />
				<label for="dia">Data de Nascimento: </label><BR/ ><input type="text" name="dia" size="2" maxlength="2" />/<input type="text" name="mes" size="2" maxlength="2" >/<input type="text" name="ano" size="4" maxlength="4" > <BR />
				<label for="mail">E-mail: </label><BR/ ><input type="text" name="mail" size="30" /> <BR />
				<label for="bos">Observações:</label><BR/ > <textarea name="obs" cols="50" rows="5"></textarea> <BR />
			</div>
		</form>
	</div>
	
	<div class="clear"></div> 
	</div> 
	<div id="footer">
		<p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
	</div>
	</body>
</html>
