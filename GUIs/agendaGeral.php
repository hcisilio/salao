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
<title> Agenda Geral </title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
</head>

<body>
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">
	<form action="../Controladores/controlador.php" method='GET'>
		<input type="hidden" name="classe" value="Agenda">
		<input type="hidden" name="metodo" value="agendaGeral">
		<ul id="menu"> 		
			<li> <input type="submit" class ="linkSubmit" value="Consultar"> </li>
			<li><a href="../GUIs/index<?php echo"$perfil";?>.php">Home</a></li>
		</ul>
		<div id="formDireita">
			<label for="funcionario">Funcionário: </label> <BR />
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
					echo "</select> <BR />";
				?>
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