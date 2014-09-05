<?php
	session_start();	
	$total = $_SESSION["total"];	
	$cnpjs = $_SESSION["cnpjs"];
	$nomes = $_SESSION["nomes"];
	//liberando as variáveis de sessão
	unset($_SESSION["total"]);
	unset($_SESSION["cnpjs"]);
	unset($_SESSION["nomes"]);
?>
<html>
<head>
<title>Listar Fornecedor</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="../style-popup.css" />
<script>	
	function enviarDados(cnpj, nome){
		window.opener.document.getElementById('cnpj').value = cnpj;
		window.opener.document.getElementById('fornecedor').value = nome;
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
				<td colspan ="3"> Seleção de Fornecedor </td> 
			</tr>
			<tr>
				<td colspan = '3'>  </td>
			</tr>
				<td> CNPJ </td> 
				<td> Nome </td>
			</tr>
			<?php
				for ($i=0; $i<$total; $i++){
					$cnpj = $cnpjs["$i"];
					$nome = $nomes["$i"];
					echo "					
						<tr>                
						<td><a href=\"javaScript:enviarDados('$cnpj', '$nome')\">$cnpj</a></td>
						<td>$nome</td>
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