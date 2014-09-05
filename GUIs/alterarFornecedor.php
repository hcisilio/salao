<?php
	session_start();
	$perfil=$_SESSION["permissao"];
	if ( ($perfil == "Gerente") || ($perfil == "Administrador") ){
	}
	else {
		$_SESSION["msg"] = "VocÃª nÃ£o pode acessar esta pÃ¡gina!";
		$_SESSION["erro"] = "PÃ¡gina requisitada sÃ³ pode ser acessada por usuÃ¡rios com perfil \"Administrador\" ou \"Gerente\"  ";
		header("location: saidas/erro.php");
	}
?>
<html>
<head>
	<title> Alterar Dados do Fornecedor </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
	<script type="text/javascript" src="../Controladores/Ajax/jQuery.js"></script>
	<script type="text/javascript" src="scripts/funcoes.js"></script>
	<script>
		function validar () {
			//nome nao pode ficar em branco
			if(document.fornecedor.nome.value == ""){
				alert ("Campo nome em branco!");
				document.fornecedor.nome.focus();
				return false;
			}
			//rua nao pode ficar em branco
			if(document.fornecedor.rua.value == ""){
				alert ("Campo rua em branco!");
				document.fornecedor.rua.focus();
				return false;
			}
			//numero nao pode ficar em branco e deve conter apenas caracteres numericos
			if ((document.fornecedor.numero.value == "") || (isNaN(document.fornecedor.numero.value))){
				alert ("Campo número inválido!");
				document.fornecedor.numero.focus();
				return false;
			}
			//bairro nao pode ficar em branco
			if(document.fornecedor.bairro.value == ""){
				alert ("Campo bairro em branco!");
				document.fornecedor.bairro.focus();
				return false;
			}
			//cidade nao pode ficar em branco
			if(document.fornecedor.cidade.value == ""){
				alert ("Campo cidade em branco!");
				document.fornecedor.cidade.focus();
				return false;
			}
			//CEP não deve ficar em branco
			if (document.fornecedor.cep.value == "") {
				alert("Campo CEP em branco!");
				document.fornecedor.cep.focus();
				return false;
			}
			//validação do telefone
			if (document.fornecedor.fone.value == "") {
				alert("Campo telefone em branco!");
				document.fornecedor.fone.focus();
				return false;
			}
		}
	</script>
	<script>
		function pesquisar() {
			$.ajax({
				type: "GET",
				url: "../Controladores/controlador.php",
				data: "acao=controlador&classe=" + $('#classe').val() + "&metodo=" + $('#metodo').val() + "&q=" + $('#q').val(),
				
				beforeSend: function() {
					// enquanto a função esta sendo processada, você
					// pode exibir na tela uma
					// msg de carregando
				},
				success: function(txt) {
					// pego o id da div que envolve o select com
					// name="id_modelo" e a substituiu
					// com o texto enviado pelo php, que é um novo
					//select com dados da marca x
					$('#box').html(txt);		
				},
				error: function(txt) {
					// em caso de erro você pode dar um alert('erro');
				}				
			});
		}
	</script>
</head>

<body>
	<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
	<div id="shadow">
		<!--form id='logon' name='logon'><-->
			<ul id="menu"> 
				<li><input type='button' value='Pesquiar CNPJ' class='linkSubmit' onClick='JavaScript:pesquisar();'> </li>	
				<li><a href="../GUIs/index<?php echo"$perfil";?>.php">Home</a></li>
			</ul>
			<div id="formDireita">
				<input type='hidden' id='classe' name='classe' value='Fornecedor'>
				<input type='hidden' id='metodo' name='metodo' value='prepararAlteracao'>
				CNPJ: <Input type="text" id="q" name="q" size="15" onKeyUp="javascript:maskCPFq(this.value)">				
			</div>
		<!--form><-->
		<div id="box">
			<form action='../Controladores/controlador.php' name='fornecedor' method='post' onSubmit='JavaScript:return validar()'>
			<ul id='menu'> 
				<li><input type='submit' value='Atualizar' class='linkSubmit'> </li>	
			</ul>
			<div id='formDireita'>							
					<input type='hidden' name='classe' value='Fornecedor'>
					<input type='hidden' name='metodo' value='alterar'>
					<input type='hidden' name='cnpj' size='30' readonly />			
					<label for='nome'>Nome da Empresa: </label><BR/ > <input type='text' id='nome' name='nome' size='30' readonly/> <BR /> 
					<label for='rua'>Rua: </label><BR/ ><input type='text' id='rua' name='rua' size='30' readonly/>  <BR />
					<label for='numero'>NÃºmero: </label><BR/ ><input type='text' id='numero' name='numero' size='30' readonly /> <BR /> 
					<label for='bairro'>Bairro: </label><BR/ ><input type='text' id='bairro' name='bairro' size='30' readonly /> <BR />
					<label for='cidade'>Cidade: </label><BR/ ><input type='text' id='cidade' name='cidade' size='30' readonly /> <BR />
					<label for='cep'>CEP: </label><BR/ ><input type='text' id='cep' name='cep' size='30' readonly onKeyUp='javascript:maskCEP(this.value)' />  <BR />
					<label for='fone'>Telefone: </label><BR/ ><input type='text' id='fone' name='fone' size='30' readonly onKeyUp='javascript:maskFone(this.value)'/> <BR />									
					<label for='mail'>E-mail: </label><BR/ ><input type='text' id='mail' name='mail' size='30' readonly /> <BR />					
				</form>	
			</div>
			
		</div>
		<div class="clear"></div> 
		</div> 
		<div id="footer">
			<p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>
	</div>
</body>
</html>
