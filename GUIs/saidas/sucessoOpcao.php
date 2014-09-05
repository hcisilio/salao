<?php 
	session_start();
	$link = $_SESSION["permissao"];
	$msg = $_SESSION["msg"];
	$pergunta = $_SESSION["pergunta"];
	$sim = $_SESSION["sim"];
	unset ($_SESSION["msg"]);
	unset ($_SESSION["pergunta"]);
	unset ($_SESSION["sim"]);
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="../style.css" />
<title>Inserido</title>
</head>

<body>
<div id="header"> <a href="index.html"> <img src="../images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">
	<ul id="menu"> 		
		
	</ul>
	<div id="formDireita">
		<?php
			echo "$msg <BR />";
			echo "$pergunta <BR />";	
			echo "<a href='$sim' class='content_button'> Sim </a> <a href='../index$link.php' class='content_button'> Não </a>";
		?>
		<div class="clear"></div>		
	</div>
</div>
<div class="clear"></div> 
</div> 
<div id="footer">
  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
</div>
</body>
</html>