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
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
<title>Restaurar Senha</title>
</head>

<body>
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">
	<form action="../Controladores/controlador.php" name="atendimento" method="get" onSubmit="JavaScript:return validar()">
		<input type="hidden" name="classe" value="Fisica">
		<input type="hidden" name="metodo" value="restaurarSenha">
		<ul id="menu"> 		
			<li> <input type="submit" name="btnOK" value="Restaurar" class="linkSubmit"> </li>
			<li><a href="../GUIs/index<?php echo"$permissao";?>.php">Home</a></li>
		</ul>
		<div id="formDireita">
			<label for="funcionario"> Funcionário: </label> <BR />
			<?php
			   include("../ClassesSQL/classeFuncionarioSQL.php");
			   $persistir = new FuncionarioSQL();
			   $lista = $persistir->listarTodos();
			   echo "<select name='funcionario'>";
				   for ($i = 0; $i < count($persistir->listarTodos()); $i++) {
					   $cpf = $lista[$i]->getCPF();
					   $nome = $lista[$i]->getNome();
					   echo "<option value=$cpf> $nome </option>";
				   } 
			   echo "</select>";
			?>
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

