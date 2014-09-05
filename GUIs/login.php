<?php
	session_start();
	if (!isset($_SESSION["erro"])) {
		$_SESSION["erro"] = 0;
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
<title>Salão de Beleza - Login</title>
</head>
<body>
<!-- HEADER -->
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<!-- END HEADER -->
<div id="shadow">
  <form action="../Controladores/controlador.php" method="post">
    	<input type="hidden" name="classe" value="Fisica">
        <input type="hidden" name="metodo" value="login"> 		
		<ul id="menu">
    	<li>Salão de beleza - login</li>
		</ul>
    <div align="center" id="edito">
        <label for="mail">E-mail:</label><br />
        <input type="text" name="mail" size="30" height="25"><br />
        <label for="senha">Senha:</label><br />
        <input type="password" name="senha" size="30" height="25">
        <div id="content">
		<?php 
			if ($_SESSION["erro"] == 1) {
				echo "<script>alert('Login e/ou senha incorretos')</script>";
			}
        ?>
        <p> </p><input name="btnLogin" type="submit" class="submit" value="Login" size="30"> <p> </p></div> 
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
