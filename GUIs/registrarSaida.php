<?php
	session_start();
	$permissao=$_SESSION["permissao"];
	$idAtendimento = $_SESSION["id"];
?>
<html>
	<head>
		<title> Registrar Utilização de Produtos do Estoque </title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
		<script type="text/javascript" src="scripts/funcoes.js"></script>
	</head>
	
	<body>
	<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
	<div id="shadow">
		<form action="../Controladores/controlador.php" name="estoque" method="post">
		<input type="hidden" name="classe" value="Saida">
		<input type="hidden" name="metodo" value="inserir">
		<input type="hidden" name="idProduto" id="idProduto">
		<ul id="menu"> 
			<li><input type='submit' value='Registrar' class='linkSubmit'> </li>
			<li><a href="../GUIs/index<?php echo"$permissao";?>.php">Home</a></li>		
		</ul>
		<div id="formDireita">
			<label for="idAtendimento">Atendimento: </label><br/><input type="text" name="idAtendimento" size="20" value="<?php echo $idAtendimento?>" readonly />	<br />	 			
			<label for="produto">Produto: </label><br/><input type="text" name="produto" id="produto" size="20" readonly /> 
			<a href="#" onClick="window.open('selecionarProduto.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=400');"><img src="images/lupa.gif"></a><BR />
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
