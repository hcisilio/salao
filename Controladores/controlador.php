<?php
$classe = $_REQUEST["classe"];
$metodo = $_REQUEST["metodo"];
include_once ("../Controladores/controlador$classe.php");
$var = "controlador$classe";
$persistir = new $var();
$persistir->$metodo();
?>