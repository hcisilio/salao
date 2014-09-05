<?php
	session_start();
	$funcionario = $_SESSION["cpf"];
	$permissao=$_SESSION["permissao"];
?>
<html>
<head>
<title> Minha Agenda</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
</head>

<body>
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">
	<form action="../Controladores/controlador.php" method='GET'>
		<input type="hidden" name="classe" value="Agenda">
		<input type="hidden" name="metodo" value="minhaAgenda">
		<ul id="menu"> 		
			<li> <input type="submit" class ="linkSubmit" value="Consultar"> </li>
			<li><a href="../GUIs/index<?php echo"$permissao";?>.php">Home</a></li>
		</ul>
		<div id="formDireita">			
			<label for="dia">Data: </label> <BR /><input type="text" name="dia" size="2" maxlength="2" />/<input type="text" name="mes" size="2" maxlength="2" >/<input type="text" name="ano" size="4" maxlength="4" >		
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