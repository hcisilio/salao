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
		<title> Registrar Forncedor </title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />		
		<script type="text/javascript" src="scripts/funcoes.js"> </script>		
	</head>
	
	<body>
	<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
	<div id="shadow">
	<form action="../Controladores/controlador.php" name="fornecedor" method="post">
		<input type="hidden" name="classe" value="Fornecedor">
		<input type="hidden" name="metodo" value="inserir">
		<ul id="menu"> 
			<li><input type='submit' value='Registrar' class='linkSubmit'> </li>
			<li><a href="../GUIs/index<?php echo"$perfil";?>.php">Home</a></li>		
		</ul>		
		<div id="formDireita">
			<label for="cnpj">CNPJ: </label><BR /><input type="text" name="cnpj" size="30" /> <Br />
			<label for="nome">Nome da empresa: </label><Br /><input type="text" name="nome" size="30" /> <Br />		
			<label for="rua">Rua: </label><Br /><input type="text" name="rua" size="30" /> <Br />
			<label for="numero">Número: </label><Br /><input type="text" name="numero" size="30" /> <BR />
			<label for="bairro">Bairro: </label><Br /><input type="text" name="bairro" size="30" /> <Br />
			<label for="cidade">Cidade: </label><Br /><input type="text" name="cidade" size="30" /> <Br />
			<label for="cep">CEP: </label><Br /><input type="text" name="cep" size="30" onKeyUp="maskCEP(this.value)" /> <Br />
			<label for="mail">E-mail: </label><Br /><input type="text" name="mail" size="30" /> <Br />
			<label for="fone">Telefone: </label><Br /><input type="text" name="fone" size="30" onKeyUp="maskFone(this.value)" /> <Br />			
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
