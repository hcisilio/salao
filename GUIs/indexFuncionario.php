<?php
  session_start();
  /*if ($_SESSION["senha"] == md5(1234)){
      header("Location: alterarSenha.php");
  }*/
  $nome = $_SESSION["nome"];
  $perfil = $_SESSION["permissao"];
  $saudacao = "Bem vindo(a) $nome";  
  $perfil = "Perfil: $perfil";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
<title>Salão de beleza</title>
</head>
<script>
function doPost(formName) {
	var theForm = document.getElementById(formName);
        theForm.submit();
}
</script>
<body>
																															
<!-- HEADER -->
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<!-- END HEADER -->
<div id="shadow">
  <!-- MENU -->
  <ul id="menu">
    <li> <a href="registrarAtendimento.php">Registrar atendimento</a> </li>    
    <li> <a href="agendar.php">Agendar horário</a> </li>	
	<form action="../Controladores/controlador.php" method="post" name="logout" id="logout">
    	<input type="hidden" name="classe" value="Fisica">
	<input type="hidden" name="metodo" value="logout">
        <li><a href="javaScript:doPost('logout');"> Logout </a> </li>
	</form>
  </ul>
  <div class="clear"></div>
  <!-- END MENU -->
  <!-- EDITO -->
  <div id="edito">
    	
	<div id="content">
		<h2> <?php echo "$saudacao";?></h2> 
		<h2> <?php echo "$perfil<br><br>";?></h2> </div>		
   	</div>
  <!-- END EDITO -->
  <div id="toal"> </div>
  <!-- CONTENT -->

  <div id="content">
    <!-- SERVICES -->
    <div>
      <h1>Cadastros e relatórios</h1>
      <ul>
        <li><a href="registrarCliente.php">Registrar Cliente</a></li>
		<li> <a href="alterarCliente.php">Atualizar Cliente</a> </li>
		<li> <a href="minhaAgenda.php">Minha agenda</a> </li>	
		<li> <a href="alterarSenha.php">Alterar Minha Senha</a> </li>
      </ul>
     </div>
    <!-- END SERVICES -->
    <!-- NEWS -->
    <div id="vertical_barr">
      <h1>Produtos esgotados no estoque</h1>
      <?php
			include_once("../ClassesSQL/classeEstoqueSQL.php");
			//Situação do estoque
			$persistir = new EstoqueSQL();
			$lista = $persistir->listarEmFalta();
			$total = count($persistir->listarEmFalta());
			if ($total == 0) {
				echo "<p><em>Não há produtos esgotados no estoque</em></p>";
			} 
			else {
				for($i=0; $i<$total; $i++){
					$id =$lista[$i]->getId();
					$produto = $lista[$i]->getDescricao();
					$qtd = $lista[$i]->getQtd();
					echo "<p><em> $id - $produto: Qtd em estoque: $qtd </em></p>";
				}
			}
		?>
      </div>
    <!-- END NEWS -->
    <!-- ABOUT ME -->
    <div>
      <h1>Produtos em fim de estoque</h1>
	  <?php
			include_once("../ClassesSQL/classeEstoqueSQL.php");
			//Situação do estoque
			$persistir = new EstoqueSQL();
			$lista = $persistir->listarAcabando();
			$total = count($persistir->listarAcabando());
			if ($total == 0) {
				echo "<p><em>Não há produtos em fim de estoque</em></p>";
			} 
			else {
				for($i=0; $i<$total; $i++){
					$id =$lista[$i]->getId();
					$produto = $lista[$i]->getDescricao();
					$qtd = $lista[$i]->getQtd();
					echo "<p><em> $id - $produto: Qtd em estoque: $qtd </em></p>";
				}
			}
		?>
      <ul>
        
      </ul>
     </div>
    <!-- END ABOUT ME -->
  </div>
      <!-- END CONTENT -->
  <div class="clear"></div>
     <!-- END SHADOW -->
</div>
<!-- FOOTER -->
<div id="footer">
  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
</div>
<!-- END FOOTER -->
</div>
<!-- END HOLDER -->
</body>
</html>

