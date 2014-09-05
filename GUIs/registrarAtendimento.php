<?php
	session_start();
	$permissao=$_SESSION["permissao"];
?>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
	<title>Registrar atendimento executado</title>
	<script>
		function validar() {			
			var tamanho = document.atendimento.servicos.length;
			var resultado = 0;
			for (var i=0;i<tamanho;i++) {
				if (document.atendimento.servicos[i].checked == true) {
					resultado++;
				}
			}
			if (resultado == 0){
				alert ("Favor selecionar ao menos um serviço!");
				return false
			}
			
			if (document.atendimento.CPF.value == ""){
				alert ("Favor selecionar o cliente que foi atendido!");
				return false;
			}		
			//validação da data
			dia = (document.atendimento.dia.value); 
			mes = (document.atendimento.mes.value); 
			ano = (document.atendimento.ano.value); 
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
			if ((document.atendimento.dia.value == "")||(document.atendimento.mes.value == "")||(document.atendimento.ano.value == "")) { 
				situacao = "falsa"; 
			} 
			if (situacao == "falsa") { 
				alert("Data inválida!"); 
				return false; 
			}
		}
		
		function doPost(formName) {
			var theForm = document.getElementById(formName);
			theForm.submit();
		}	
		
	</script>
</head>

<body>
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">
  <form action="../Controladores/controlador.php" name="atendimento" id="atendimento" method="get" onSubmit="JavaScript:return validar()">
    <input type="hidden" name="classe" value="Atendimento">
    <input type="hidden" name="metodo" value="inserir">
    <input type="hidden" name="CPF" id="CPF">
		<ul id="menu"> 
			<li><input type='submit' value='Registrar' class='linkSubmit'> </li>
			<li><a href="../GUIs/index<?php echo"$permissao";?>.php">Home</a></li>		
		</ul>			
		<div align='center' id='ckbox'> 
		<h1>Serviços realizados</h1>	<p> </p>			
		<?php
			include_once("../ClassesSQL/classeServicoSQL.php");
			$persistir = new ServicoSQL();
			$lista = $persistir->listarTodos();
			$total = count($persistir->listarTodos());
			if ($total == 0) {
				echo "Erro! Produtos não localizados <BR /> Favor verificar conexão com o banco de dados!";
			} 
			else {
				for($i=0; $i<$total; $i++){
					$id =$lista[$i]->getId();
					$tipo = $lista[$i]->getTipo();
					$preco = $lista[$i]->getPreco();
					echo "<INPUT TYPE='checkbox' NAME='servicos[]' id='servicos' VALUE='$id'> $tipo - R$".number_format($preco,2,',','.')."<br />";
				}
			}
		?>
		<br><br><br>
		</div>
	  <div align='center' id='formDireita'>
	  <h1>Dados do cliente</h1>	<p> </p>
      <label for="cliente">Cliente: </label><BR /><input type="text" name="cliente" id="cliente" size="30"  readonly/>
      <a href="#" onClick="window.open('selecionarCliente.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=400');"><img src="images/lupa.gif"></a><BR />
      <label for="funcionario">Funcionário: </label> <BR />
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
            echo "</select><BR />";
		?>
      
    <label for="dia">Data: </label> <BR /> <input type="text" name="dia" size="2" maxlength="2" />/<input type="text" name="mes" size="2" maxlength="2" >/<input type="text" name="ano" size="4" maxlength="4" ><BR />
    <label for="pagamento">Forma de pagamento: </label> <BR />  
      <select name='pagamento' > 
		  <option value='Dinheiro'> Dinheiro </option> 
		  <option value = 'Cartão'> Cartão </option>
		  <option value = 'Cheque'> Cheque </option>
      </select> <BR />     
		<div class="clear"></div> 
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
