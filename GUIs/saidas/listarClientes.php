<?php
	session_start();	
	$link = $_SESSION["permissao"];
	$total = $_SESSION["total"];	
	$cpfs = $_SESSION["cpfs"];
	$nomes = $_SESSION["nomes"];
	$mails = $_SESSION["mails"];
	//Liberando as variáveis de sessão
	unset ($_SESSION["total"]);
	unset ($_SESSION["cpfs"]);
	unset ($_SESSION["nomes"]);
	unset ($_SESSION["mails"]);
	
?>
<html>
<head>
<title>Selecionar Cliente</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="../style-popup.css" />
<script>
	function enviarDados(cpf, nome){
		window.opener.document.getElementById('CPF').value = cpf;
		window.opener.document.getElementById('cliente').value = nome;
		window.close();
	}
</script>
</head>

<body>
<div id="shadow">
	<ul id="menu"> 				
		<a href='javascript:window.history.go(-1)'> <img src='../images/go-back-button.png'> </a>
	</ul>	
	<div id="conteudo">
		<table class="tabela">
			<tr>
				<td colspan ="3"> Seleção de cliente </td> 
			</tr>
			<tr>
				<td colspan = '3'>  </td>
			</tr>
			<tr>
				<td> CPF </td> 
				<td> Nome </td>
				<td> E-mail </td>			
			</tr>
			<?php
			for ($i=0; $i<$total; $i++){
				$cpf = $cpfs["$i"];
				$nome = $nomes["$i"];
				$mail = $mails["$i"];
				echo "
					<tr>
					<td><a href=\"javaScript:enviarDados('$cpf','$nome');\">$cpf</a></td>
					<td>$nome</td>
					<td>$mail</td>
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