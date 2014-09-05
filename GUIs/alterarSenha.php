<?php
	session_start();
	$permissao=$_SESSION["permissao"];
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
<title>Alterar Senha</title>
<script type="text/javascript">
	function validar () {
		if(document.funcionario.atual.value == ""){
			alert ("Favor informar a senha utilizada atualmente");
			document.funcionario.atual.focus();
			return false;
		}
		if(document.funcionario.nova.value == ""){
			alert ("Favor informar a nova senha");
			document.funcionario.nova.focus();
			return false;
		}
		if(document.funcionario.confirmNova.value == ""){
			alert ("Favor confirmar a nova senha");
			document.funcionario.confirmNova.focus();
			return false;
		}
		if(document.funcionario.nova.value != document.funcionario.confirmNova.value) {
			alert ("Campos nova senha e confirmar nova senha devem ser iguais ");
			document.funcionario.confirmNova.focus();
			return false;
		}
	}
</script>
</head>

<body>
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">
	<form action="../Controladores/controlador.php" name="funcionario" method="get" onSubmit="JavaScript:return validar()">
		<input type="hidden" name="classe" value="Fisica">
		<input type="hidden" name="metodo" value="AlterarSenha">
		<ul id="menu"> 		
			<li> <input type="submit" name="btnOK" value="Alterar" class="linkSubmit"> </li>
			<li><a href="../GUIs/index<?php echo"$permissao";?>.php">Home</a></li>
		</ul>
		<div id="formDireita">
			<label for="atual"> Senha atual: </label> <BR />
			<input type='password' name='atual' size='20'> <BR />
			<label for="nova"> Nova Senha: </label> <BR />
			<input type='password' name='nova' size='20'> <BR />
			<label for="confirmNova"> Confirmar Nova Senha: </label> <BR />
			<input type='password' name='confirmNova' size='20'> <BR />
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

