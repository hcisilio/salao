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
	<title> Alterar Dados do Funcionário </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
	<script type="text/javascript" src="../Controladores/Ajax/jQuery.js"></script>
	<script type="text/javascript" src="scripts/funcoes.js"></script>
	<script>
		function validar () {
			//nome nao pode ficar em branco
			if(document.cliente.nome.value == ""){
				alert ("Campo nome em branco!");
				document.cliente.nome.focus();
				return false;
			}
			//rua nao pode ficar em branco
			if(document.cliente.rua.value == ""){
				alert ("Campo rua em branco!");
				document.cliente.rua.focus();
				return false;
			}
			//numero nao pode ficar em branco e deve conter apenas caracteres numericos
			if ((document.cliente.numero.value == "") || (isNaN(document.cliente.numero.value))){
				alert ("Campo número inválido!");
				document.cliente.numero.focus();
				return false;
			}
			//bairro nao pode ficar em branco
			if(document.cliente.bairro.value == ""){
				alert ("Campo bairro em branco!");
				document.cliente.bairro.focus();
				return false;
			}
			//cidade nao pode ficar em branco
			if(document.cliente.cidade.value == ""){
				alert ("Campo cidade em branco!");
				document.cliente.cidade.focus();
				return false;
			}
			//CEP não deve ficar em branco
			if (document.cliente.cep.value == "") {
				alert("Campo CEP em branco!");
				document.cliente.cep.focus();
				return false;
			}
			//validação do telefone
			if (document.cliente.fone.value == "") {
				alert("Campo telefone em branco!");
				document.cliente.fone.focus();
				return false;
			}
			//CPF pode ficar em branco
			/*if (document.cliente.cpf.value == ""){
				alert ("Campo CPF em branco!");
				document.cliente.cpf.focus();
				return false;
			}*/
			//RG não pode ficar em branco
			if (document.cliente.rg.value == ""){
				alert ("Campo RG em branco!");
				document.cliente.rg.focus();
				return false;
			}			
			//validação da data
			dia = (document.cliente.dia.value); 
            mes = (document.cliente.mes.value); 
            ano = (document.cliente.ano.value); 
            situacao = ""; 
            // verifica o dia valido para cada mes 
            if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { 
                situacao = "falsa"; 
            } 
            // verifica se o mes e valido 
            if (mes < 01 || mes > 12 ) { 
                situacao = "falsa"; 
            } 
            // verifica se e ano bissexto 
            if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
                situacao = "falsa"; 
            } 
			// verifica se datas sao numericas
			if (( isNaN(dia))||( isNaN(mes))||( isNaN(ano))){
				situacao = "falsa";
			}
            if ((document.cliente.dia.value == "")||(document.cliente.mes.value == "")||(document.cliente.ano.value == "")) { 
                situacao = "falsa"; 
            } 
            if (situacao == "falsa") { 
                alert("Data inválida!"); 
				return false; 
            }
            // verifica se e-mail é válido
			/*var txt = document.cliente.mail.value;
			if ((txt.length != 0) && ((txt.indexOf("@") < 1) || (txt.indexOf('.') < 7))) {
				alert('Email incorreto');
				document.cliente.mail.focus();
				return false;
			}*/

		}
	</script>
	<script>
		
		function maskCPFq(q){
			var mcpf = '';
			mcpf = mcpf + q;
			if ( (mcpf.length == 3)||(mcpf.length == 7) ){
				mcpf = mcpf + '.';
				document.getElementById("q").value = mcpf;
			}
			if (mcpf.length == 11){
				mcpf = mcpf + '-';
				document.getElementById("q").value = mcpf;
			}
		}
		function pesquisar() {
			$.ajax({
				type: "GET",
				url: "../Controladores/controlador.php",
				data: "acao=controlador&classe=" + $('#classe').val() + "&metodo=" + $('#metodo').val() + "&q=" + $('#q').val(),
				
				beforeSend: function() {
				// enquanto a fun��o esta sendo processada, voc�
				// pode exibir na tela uma
				// msg de carregando
				},
				success: function(txt) {
				// pego o id da div que envolve o select com
				// name="id_modelo" e a substituiu
				// com o texto enviado pelo php, que � um novo
				//select com dados da marca x
					$('#box').html(txt);		
				},
				error: function(txt) {
				// em caso de erro voc� pode dar um alert('erro');
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
				<li><input type='button' value='Pesquiar CPF' class='linkSubmit' onClick='JavaScript:pesquisar();'> </li>	
				<li><a href="../GUIs/index<?php echo"$perfil";?>.php">Home</a></li>
			</ul>
			<div id="formDireita">
				<input type='hidden' id='classe' name='classe' value='Funcionario'>
				<input type='hidden' id='metodo' name='metodo' value='prepararAlteracao'>
				CPF: <Input type="text" id="q" name="q" size="15" onKeyUp="javascript:maskCPFq(this.value)">				
			</div>
		<!--form><-->
		<div id="box">
	<form action='../Controladores/controlador.php' name='funcionario' method='post' onSubmit='JavaScript:return validar()'>
			<ul id='menu'> 
				<li><input type='submit' value='Atualizar' class='linkSubmit'> </li>	
			</ul>
			<div id='formDireita'>				
					<input type='hidden' name='classe' value='Funcionario'>
					<input type='hidden' name='metodo' value='alterar'>
					<label for='nome'>Nome Completo: </label><BR/ > <input type='text' id='nome' name='nome' size='30' readonly /> <BR /> 
					<label for='rua'>Rua: </label><BR/ ><input type='text' id='rua' name='rua' size='30' readonly/>  <BR />
					<label for='numero'>Número: </label><BR/ ><input type='text' id='numero' name='numero' size='30' readonly /> <BR /> 
					<label for='bairro'>Bairro: </label><BR/ ><input type='text' id='bairro' name='bairro' size='30' readonly /> <BR />
					<label for='cidade'>Cidade: </label><BR/ ><input type='text' id='cidade' name='cidade' size='30' readonly /> <BR />
					<label for='cep'>CEP: </label><BR/ ><input type='text' id='cep' name='cep' size='30' readonly onKeyUp='javascript:maskCEP(this.value)' />  <BR />
					<label for='fone'>Telefone: </label><BR/ ><input type='text' id='fone' name='fone' size='30' readonly onKeyUp='javascript:maskFone(this.value)'/> <BR />
					<input type='hidden' name='cpf' size='30' maxlength='14' readonly onKeyUp='javascript:maskCPF(this.value)' readonly />					
					<label for='rg'>RG: </label><BR/ ><input type='text' id='rg' name='rg' size='30' readonly /> <BR />
					<label for='sexo'>Sexo </label><BR/ >
									<select name='sexo' id='sexo'>
										<option value='Masculino' $M> Masculino </option>
										<option value='Feminino' $F> Feminino </option>
									</select>  <BR />
					<label for='dia'>Data de Nascimento: </label><BR/ ><input type='text' id='dia' name='dia' size='2' maxlength='2' readonly/>/<input type='text' id='mes' name='mes' size='2' maxlength='2' readonly>/<input type='text' id='ano' name='ano' size='4' maxlength='4' readonly> <BR />
					<label for='mail'>E-mail: </label><BR/ ><input type='text' id='mail' name='mail' size='30' readonly/> <BR />
					<label for='funcao'>Função: </label> <BR /> <input type='text' id= 'funcao' name='funcao' size='30' readonly /> <BR />
					<label for='entrada'>Entrada: </label> <BR /> <input type='text' id='entrada' name='entrada' size='30' readonly maxlength='5' OnKeyUp='mascara_entrada(this.value)' /> <BR />
					<label for='saida'>Saída </label> <BR /> <input type='text' id='saida' name='saida' size='30' maxlength='5' readonly OnKeyUp='mascara_saida(this.value)'/> <BR />
					<label for='comissao'>Comissão: </label> <BR /> </td><td><input type='text' id='comissao' name='comissao' size='30' readonly /> <BR />
					<label for='salario'>Salário: </label> <BR /> <input type='text' id='salario' name='salario' size='30' readonly /> <BR />				
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