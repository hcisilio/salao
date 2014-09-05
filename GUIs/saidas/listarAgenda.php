<?php
	session_start();
	$link = $_SESSION["permissao"];
	$funcionario = $_SESSION["funcionario"];
	$data = $_SESSION["data"];
	$total = $_SESSION["total"];
	$clientes = $_SESSION["clientes"];
	$horas = $_SESSION["horas"];
	$servicos = $_SESSION["servicos"];
	
	//Liberando variáveis de sessão
	unset ($_SESSION["funcionario"]);
	unset ($_SESSION["data"]);
	unset ($_SESSION["total"]);
	unset ($_SESSION["clientes"]);
	unset ($_SESSION["horas"]);
	unset ($_SESSION["servicos"]);
?>
<html>
<head>
<title>Agenda de <?php echo $funcionario ?> em <?php echo date("d/m/Y", strtotime($data)); ?>></title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="../style.css" />
</head>

<body>
<div id="header"> <a href="index.html"> <img src="../images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">
	<ul id="menu"> 		
		<a href='../index<?php echo $link ?>.php'> <img src='../images/button_home.png'> </a>	
		<a href='javascript:window.history.go(-1)'> <img src='../images/go-back-button.png'> </a>
	</ul>	
	<div id="formDireita">
		<table class="tabela">
			<tr>
				<td colspan ="3"> Agenda de <?php echo $funcionario ?> </td> 
			</tr>
			<tr>
				<td colspan = '3'> Data: <?php echo date("d/m/Y", strtotime($data)); ?> </td>
			</tr>
			<tr>
				<td>Hora</td>
				<td>Cliente</td>
				<td>Serviço</td>
			</tr>
			<?php
			for ($i=0; $i<$total; $i++){
				$hora = $horas["$i"];
				$cliente = $clientes["$i"];
				$servico = $servicos["$i"];
				echo "
					<tr>
					<td>$hora</td>
					<td>$cliente</td>
					<td>$servico</td>
					</tr>
				";
			}
			?>
		</table>
	</div>
</div>
<div class="clear"></div> 
</div> 
<div id="footer">
  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
</div>
</body>
</html>