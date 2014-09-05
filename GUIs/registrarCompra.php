<?php
	session_start();
	$perfil=$_SESSION["permissao"];
	if ( ($perfil == "Gerente") || ($perfil == "Administrador") ){
	}
	else {
		$_SESSION["msg"] = "Você não pode acessar esta página!";
		$_SESSION["erro"] = "Página requisitada só pode ser acessada por usuários com perfil \"Administrador\" ou \"Gerente\"  ";
		header("location: saidas/erro.php");
	}
?>
<html>
	<head>
		<title> Registrar compra para o estoque </title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />		
		<script type="text/javascript" src="scripts/funcoes.js"> </script>	
		<script>
			function validar() {
						
				//validação da data
				dia = (document.forms[0].dia.value); 
				mes = (document.forms[0].mes.value); 
				ano = (document.forms[0].ano.value); 
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
				if ((document.forms[0].dia.value == "")||(document.forms[0].mes.value == "")||(document.forms[0].ano.value == "")) { 
					situacao = "falsa"; 
				} 
				if (situacao == "falsa") { 
					alert("Data inválida!"); 
					return false; 
				}
			}
		</script>
	</head>
	
	<body>
	<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
	<div id="shadow">
	<form action="../Controladores/controlador.php" name="compra" method="get" onSubmit="JavaScript:return validar();">
		<input type="hidden" name="classe" value="Compra">
		<input type="hidden" name="metodo" value="inserir">
		<input type="hidden" name="cnpj" id="cnpj">
		<ul id="menu"> 
			<li><input type='submit' value='Registrar' class='linkSubmit'> </li>
			<li><a href="../GUIs/index<?php echo"$perfil";?>.php">Home</a></li>		
		</ul>		
		<div id="formDireita">
			<label for="nota">Nota fiscal: </label><BR /><input type="text" name="nota" size="30" /> <Br />
			<label for="fornecedor">Fornecedor: </label><BR /><input type="text" name="fornecedor" id="fornecedor" size="30" readOnly/>
			<a href="#" onClick="window.open('selecionarFornecedor.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');"><img src="images/lupa.gif"></a><Br />
			<label for="id">Código do produto: </label><Br /><input type="text" name="id" size="30" /> <Br />		
			<label for="valor">Valor unitário: </label><Br /><input type="text" name="preco" size="30" onKeyUp="maskMoney(this.value)"/> <Br />
			<label for="qtd">Quantidade: </label><Br /><input type="text" name="qtd" size="30" /> <BR />
			<label for="dia">Data: </label><Br /><input type="text" name="dia" size="2" maxlength="2" />/<input type="text" name="mes" size="2" maxlength="2" >/<input type="text" name="ano" size="4" maxlength="4" >  <Br />	
		</div>
	</div>
	</form>
		<div class="clear"></div> 
	</div> 
	<div id="footer">
		<p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
	</div>
	</body>
</html>
