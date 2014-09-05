<?php
	session_start();	
	$link = $_SESSION["permissao"];
	$total = $_SESSION["total"];	
	$ids = $_SESSION["ids"];
	$descricoes = $_SESSION["descricoes"];
	//Liberando as variáveis de sessão
	unset ($_SESSION["total"]);
	unset ($_SESSION["ids"]);
	unset ($_SESSION["descricoes"]);	
?>
<html>
<head>
<title>Selecionar Produto</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="../style-popup.css" />
<script>
	function enviarDados(id, descricao){
		window.opener.document.getElementById('idProduto').value = id;
		window.opener.document.getElementById('produto').value = descricao;
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
				<td colspan ="2"> Seleção de Produto </td> 
			</tr>
			<tr>
				<td colspan = '2'>  </td>
			</tr>
			<tr>
				<td> ID </td> 
				<td> Descrição </td>			
			</tr>
			<?php
			for ($i=0; $i<$total; $i++){
				$id = $ids["$i"];
				$descricao = $descricoes["$i"];
				echo "
					<tr>
					<td><a href=\"javaScript:enviarDados('$id','$descricao');\">$id</a></td>
					<td>$descricao</td>
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