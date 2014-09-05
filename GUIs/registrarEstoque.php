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
		<title> Registrar produto no estoque </title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
		<script type="text/javascript" src="scripts/funcoes.js"></script>
	</head>
	
	<body>
	<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
	<div id="shadow">
		<form action="../Controladores/controlador.php" name="estoque" method="post">
		<input type="hidden" name="classe" value="Estoque">
		<input type="hidden" name="metodo" value="inserir">
		<ul id="menu"> 
			<li><input type='submit' value='Registrar' class='linkSubmit'> </li>
			<li><a href="../GUIs/index<?php echo"$perfil";?>.php">Home</a></li>		
		</ul>
		<div id="formDireita">
		  <label for="id">Código de barras: </label><br/><input type="text" name="id" size="20" /> <br />
		  <label for="descricao">Descrição: </label><br/><input type="text" name="descricao" size="50" /> <br />
		  <label for="preco_venda">Preço de venda: </label><br/><input type="text" name="preco" size="10" onKeyUp="maskMoney(this.value)" /> <br />
		  <label for="qtd">Quantidade: </label><br/><input type="text" name="qtd" size="5" /> <br />
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
