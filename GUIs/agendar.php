<?php
	session_start();
	$permissao=$_SESSION["permissao"];
?>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
	<title>Agendar Horário</title>
	<script type="text/javascript" src="scripts/funcoes.js"></script>
	<script>
		function mascara_hora(saida){ 
			var myhora = ''; 
			myhora = myhora + saida; 
			if (myhora.length == 2){ 
				myhora = myhora + ':'; 
				document.agenda.hora.value = myhora; 
			} 
		}
		function validar () {
			//validação do cliente
			if (document.agenda.CPF.value == ""){
				alert ("Favor selecionar o cliente que está sendo agendado!");
				return false;
			}
			//validação da hora
			hrs = (document.agenda.hora.value.substring(0,2)); 
			min = (document.agenda.hora.value.substring(3,5)); 
			situacao = "";
			if ((hrs < 00 ) || (hrs > 23) || ( min < 00) ||( min > 59)){ 
				situacao = "falsa"; 
			}    
			if (isNaN(hrs)||isNaN(min)){
				situacao = "falsa";
			}               
			if (document.agenda.hora.value == "") { 
				situacao = "falsa"; 
			} 
			if (situacao == "falsa") { 
				alert("Hora inválida!"); 
				this.focus();
				return false;
			}
			//validação da data
			dia = (document.agenda.dia.value); 
			mes = (document.agenda.mes.value); 
			ano = (document.agenda.ano.value); 
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
			if ((document.agenda.dia.value == "")||(document.agenda.mes.value == "")||(document.agenda.ano.value == "")) { 
				situacao = "falsa"; 
			} 
			if (situacao == "falsa") { 
				alert("Data inválida!"); 
				return false; 
			}
		}
	</script>
</head>

<body>
	<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
	<div id="shadow">
		<form action="../Controladores/controlador.php" name="agenda" method="post" onSubmit="JavaScript:return validar()">
		<input type="hidden" name="classe" value="Agenda">
		<input type="hidden" name="metodo" value="inserir">
		<input type="hidden" name="CPF" id="CPF">
		<ul id="menu"> 
			<li><input type='submit' value='Registrar' class='linkSubmit'> </li>
			<li><a href="../GUIs/index<?php echo"$permissao";?>.php">Home</a></li>		
		</ul>
		<div id="formDireita">
			<label for="cliente">Cliente: </label> <BR /><input type="text" name="cliente" id="cliente" size="30" readonly/>
			<a href="#" onClick="window.open('selecionarCliente.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');"><img src="images/lupa.gif" size="8x8"></a><BR />
			<label for="funcionario">Funcionario: </label> <BR />
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
			<BR />
			<label for="dia">Data: </label> <BR /><input type="text" name="dia" size="2" maxlength="2" />/<input type="text" name="mes" size="2" maxlength="2" >/<input type="text" name="ano" size="4" maxlength="4" > <BR />
			<label for="hora">Hora: </label> <BR /><input type="text" name="hora" size="10" OnKeyUp="mascara_hora(this.value)" maxlength="5"/> <BR />
			<label for="servico">Serviços: </label> <BR /><textarea name="servico" cols="50" rows="5"></textarea><BR />
		</div>
		<div class="clear"></div> 
		</div> 
		<div id="footer">
			<p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>
	  </form>
  
</body>
</html>
