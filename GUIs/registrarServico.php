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
		<title> Registrar serviço </title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
		<script type="text/javascript" src="scripts/funcoes.js"></script>
	</head>
	
	<body>
		<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
		<div id="shadow">
			<form action="../Controladores/controlador.php" name="servico" method="post">
			<input type="hidden" name="classe" value="Servico">
			<input type="hidden" name="metodo" value="inserir">
			<ul id="menu"> 
				<li><input type='submit' value='Registrar' class='linkSubmit'> </li>
				<li><a href="../GUIs/index<?php echo"$permissao";?>.php">Home</a></li>		
			</ul>
			<div id="formDireita">
			  <label for="nome">Descrição do serviço: </label> <BR /><input type="text" name="tipo" size="30" /> <BR />
			  <label for="preco">Preço: </label> <BR /><input type="text" name="preco" size="10" onKeyUp="maskMoney(this.value)" /> <BR />			  
			</div>			
		</div>
		<div class="clear"></div> 
		</div> 
		<div id="footer">
			<p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>
	</body>

</html>
