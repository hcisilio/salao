<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style-popup.css" />
<title>Selecionar cliente</title>
</head>
<body>
<div id="shadow">
	<form name='buscarCliente' action='../Controladores/controlador.php' method='get'>
		<input type="hidden" name="classe" value="Cliente">
		<input type="hidden" name="metodo" value="buscar">
		<ul id="menu">
			<li> <input type='submit' name='btnBuscar' value='Buscar' class="linkSubmit"></a>
		</ul>
		<div id="conteudo">
			<label for="nome"> Nome: </label><BR />
			<input type='text' name='nome' size='15'> <font class="obs"> Obs.: Deixe em branco para buscar todos os clientes
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