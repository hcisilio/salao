<?php
	session_start();
	$link = $_SESSION["permissao"];
	$titulo = $_SESSION["titulo"];
	$total = $_SESSION["total"];
	$ids = $_SESSION["ids"];
	$funcionarios = $_SESSION["funcionarios"];
	$datas = $_SESSION["datas"];	
	$clientes = $_SESSION["clientes"];
	$valores = $_SESSION["valores"];
	$caixa = $_SESSION["caixa"];
	
	//Liberando variáveis de sessão
	unset ($_SESSION["titulo"]);
	unset ($_SESSION["total"]);
	unset ($_SESSION["ids"]);
	unset ($_SESSION["funcionarios"]);
	unset ($_SESSION["datas"]);
	unset ($_SESSION["clientes"]);
	unset ($_SESSION["valores"]);
	unset ($_SESSION["caixa"]);
?>
<html>
<head>
<title> <?php echo $titulo ?> </title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="../style.css" />
<script>
	function detalharAtendimento(atendimento){
		window.open('../detalhesAtendimento.php?atendimento='+atendimento, 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=800, HEIGHT=600');
		//alert ("detalhando atendimento" + atendimento);
		/*$.ajax({
			type: "GET",
			url: "../detalhesAtendimento.php",
			data: "acao=detalhesAtendimento&atendimento=" + atendimento,
			
			beforeSend: function() {
			},
			success: function() {
				window.open('detalhesAtendimento.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=400');	
			},
			error: function() {
			}				
		});*/
	}
</script>
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
				<td colspan ="5"> <?php echo $titulo ?> </td> 
			</tr>
			<tr>
				<td colspan = '5'> Mês de referência: <?php echo date("m", strtotime($datas[0])); ?> </td>
			</tr>
			<tr>
				<td>Atendimento</td>
				<td>Cliente</td>
				<td>Funcionario</td>
				<td>Data</td>
				<td>Valor</td>
			</tr>
			<?php
			for ($i=0; $i<$total; $i++){
				$atendimento = $ids["$i"];
				$cliente = $clientes["$i"];
				$funcionario = $funcionarios["$i"];
				$data = date("d/m/Y", strtotime($datas["$i"]));
				$valor = number_format($valores["$i"], 2, ",", ".");
				//$valor = $valores["$i"];
				echo "
					<tr>
					<td><a href=\"javaScript:detalharAtendimento('$atendimento');\">$atendimento</a></td>
					<td>$cliente</td>
					<td>$funcionario</td>
					<td>$data</td>
					<td>R$ $valor</td>
					</tr>
				";
			}
			?>
			<tr>
				<td colspan = "4" align="right"> Caixa total do mês = </td>
				<td> <?php echo "R$ "; echo number_format($caixa, 2, ",", "."); ?> </td>
			</tr>
		</table>
		<div id="box">
		</div>
	</div>
</div>
<div class="clear"></div> 
</div> 
<div id="footer">
  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
</div>
</body>
</html>