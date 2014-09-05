<?php
	session_start();
	$perfil = $_SESSION["permissao"];
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
<title>Mais Opções</title>
</head>
<body>
																															
<!-- HEADER -->
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<!-- END HEADER -->
<div id="shadow">
  <!-- MENU -->
  <ul id="menu">
    <li> <a href="indexGerente.php">Home</a> </li>    		
  </ul>
  <div class="clear"></div>
  <!-- END MENU -->  
  <!-- CONTENT -->
  <div id="content">
    <!-- SERVICES -->
    <div>
      <h1>Cadastros</h1>
      <ul>
        <li><a href="registrarCliente.php">Registrar Cliente</a></li>		
		<li> <a href="registrarFuncionario.php">Registrar Funcionáo</a> </li>	
		<li> <a href="registrarFornecedor.php">Registrar Fornecedor</a> </li>			
		<li> <a href="registrarEstoque.php">Registrar Estoque</a> </li>	
		<li> <a href="registrarServico.php">Registrar Servico</a> </li>
		<li> <a href="registrarCompra.php">Registrar Compra de Produtos</a> </li>		
      </ul>
     </div>
    <!-- END SERVICES -->
    <!-- NEWS -->
    <div id="vertical_barr">
      <h1>Atualizações e Exclusões</h1>
      <ul>
		<li> <a href="alterarCliente.php">Atualizar Cliente</a> </li>
		<li> <a href="alterarFuncionario.php">Atualizar Funcionário</a> </li>
		<li> <a href="alterarFornecedor.php">Atualizar Fornecedor</a> </li>	
		<li> <a href="alterarSenha.php">Alterar Minha Senha</a> </li>
		<li> <a href="restaurarSenha.php">Restaurar Senha do Funcionário</a> </li>
		<li> <a href="alterarPermissao.php">Alterar permissão do funcionário</a> </li>
	  </ul>
      </div>
    <!-- END NEWS -->
    <!-- ABOUT ME -->
    <div>
      <h1>Consultas e Reltórios</h1>
      <ul>
		<li> <a href="minhaAgenda.php">Minha agenda</a> </li>	
        <li> <a href="agendaGeral.php">Agenda geral</a> </li>	
		<li> <a href="listarCaixa.php">Relatório de Caixa</a> </li>	
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