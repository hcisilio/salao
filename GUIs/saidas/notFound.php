<?php 
	session_start();
	$link = $_SESSION["permissao"];
	$msg = $_SESSION["msg"];
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="../style.css" />
<title>Objeto não encontrado</title>
</head>

<body>
<div id="header"> <a href="index.html"> <img src="../images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">
	<ul id="menu"> 		
		<a href='../index<?php echo $link ?>.php'> <img src='../images/button_home.png'> </a>	
		<a href='javascript:window.history.go(-1)'> <img src='../images/go-back-button.png'> </a>
	</ul>
	<div id="formDireita">
		<?php
			echo "$msg";
			unset ($_SESSION["msg"]);
		?>
	</div>
</div>
<div class="clear"></div> 
</div> 
<div id="footer">
  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
</div>
</body>
</html>