<?php
session_start();
if ($_SESSION['logado'] == 'true'){
	$link = $_SESSION["permissao"];
	header ("location: GUIs/index$link.php");
} 
else {header("Location: GUIs/login.php");}
?>