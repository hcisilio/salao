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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
	<script>
		function validarPorFuncionario(){
			if(document.porFuncionario.ano.value == ""){
				alert ("Campo ano em branco!");
				document.porFuncionario.ano.focus();
				return false;
			}
		}
		function validarGeral(){
			if(document.geral.ano.value == ""){
				alert ("Campo ano em branco!");
				document.geral.ano.focus();
				return false;
			}
		}
	</script>
	<title>Consulta de Caixa</title>
</head>

<body>
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">	
	<form name="porFuncionario" action="../Controladores/controlador.php" method="get" onSubmit="JavaScript:return validarPorFuncionario()">
	<input type="hidden" name="classe" value="Atendimento">
	<input type="hidden" name="metodo" value="listarCaixaFuncionario">	
	<ul id="menu">
		<li> <input type="submit" value="Consultar" class="linkSubmit"> </li>
	</ul>
	<div id="formDireita">
		<h1> Caixa por Funcionário </h1> <p> </p>
		Funcionário:  
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
		Mês:
		<select name="mes">
			<option value="01"> Janeiro </option>
			<option value="02"> Fevereiro </option>
			<option value="03"> Março</option>
			<option value="04"> Abil </option>
			<option value="05"> Maio</option>
			<option value="06"> Junho </option>
			<option value="07"> Julho </option>
			<option value="08"> Agosto </option>
			<option value="09"> Setembro </option>
			<option value="10"> Outubro </option>
			<option value="11"> Novembro </option>
			<option value="12"> Dezembro </option>
		</select>
		Ano: <input type="text" name="ano" size="5"> 
		</form>
	</div>	
	<form name="geral" action="../Controladores/controlador.php" method="get" onSubmit="JavaScript:return validarGeral()">
	<input type="hidden" name="classe" value="Atendimento">
	<input type="hidden" name="metodo" value="listarCaixa">	
	<ul id="menu">
		<li> <input type="submit" value="Consultar" class="linkSubmit"> </li>
	</ul>		
	<div id="formDireita">
		<h1> Caixa Geral </h1> <p> </p>
		Mês:  
		<select name="mes">
			<option value="01"> Janeiro </option>
			<option value="02"> Fevereiro </option>
			<option value="03"> Março</option>
			<option value="04"> Abil </option>
			<option value="05"> Maio</option>
			<option value="06"> Junho </option>
			<option value="07"> Julho </option>
			<option value="08"> Agosto </option>
			<option value="09"> Setembro </option>
			<option value="10"> Outubro </option>
			<option value="11"> Novembro </option>
			<option value="12"> Dezembro </option>
		</select>  
		  Ano:   <input type="text" name="ano" size="5"> 		  
	</form>
	</div>
</div>
<div class="clear"></div> 
</div> 
<div id="footer">
  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
</div>
</body>
</html>
