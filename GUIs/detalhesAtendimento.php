<?php
	session_start();
	$link = $_SESSION["permissao"];
	
	// EFETUANDO AS CONSULTAS DOS DETALHES DO ATENDIMENTO
	include_once("../ClassesSQL/classeAtendimentoSQL.php");
	include_once("../ClassesSQL/classeAtendimentoServicoSQL.php");
	include_once("../ClassesSQL/classeSaidaSQL.php");
	$id = $_REQUEST["atendimento"];	
	//Coletando os dados do atendimento
	$persistir = new AtendimentoSQL();
	$atendimento = $persistir->listar($id);
	$cliente = $atendimento->getCliente()->getNome();
	$funcionario = $atendimento->getFuncionario()->getNome();
	$data = date("d/m/Y", strtotime($atendimento->getData()));
	$pagamento = $atendimento->getPagamento();
	//Coletando os dados dos serivços prestados no atendimento
	$persistir = new AtendimentoServicoSQL();
	$atendServ = $persistir->listarPorAtendimento($id);	
	//Coletando os dados do uso de produtos no atendimento;
	$persistir = new SaidaSQL();
	$saida = $persistir->listarPorAtendimento($id);
?>
<html>
<head>
<title> Atendimento Detalhado </title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
</head>

<body>
<div id="header"> <a href="index.html"> <img src="images/logo.png" alt="logo" width="273" height="103"/> </a> </div>
<div id="shadow">
	<ul id="menu"> 		
		<a href='index<?php echo $link ?>.php'> <img src='images/button_home.png'> </a>	
		<a href='javascript:window.history.go(-1)'> <img src='images/go-back-button.png'> </a>
	</ul>
	<div id="formDireita">
		<table class="tabela">
			<tr>
				<td colspan ="5"> Atendimento detalhado </td> 
			</tr>
			<tr>
				
			</tr>
			<tr>
				<td>Atendimento</td>
				<td>Cliente</td>
				<td>Funcionario</td>
				<td>Data</td>				
				<td>Pagamento</td>
			</tr>
			<?php				
				echo "
					<tr>
					<td>$id</td>
					<td>$cliente</td>
					<td>$funcionario</td>
					<td>$data</td>
					<td>$pagamento</td>
					</tr>
				";
			?>
			<tr>
				<td colspan = '5' bgcolor='0099CC' align='center'> <Strong>Detalhamento dos serviços prestados</strong> </td>
			</tr>
			<tr bgcolor='0099CC' align='center'>
				<td colspan = "3" > <strong>Serviço</strong> </td>
				<td colspan = "2" > <strong>Valor Pago</strong> </td>				
			</tr>
			<?php
				$total = 0;
				foreach ($atendServ as $as) {
					$tipo = $as->getServico()->getTipo();
					//$desconto = $as->getDesconto();
					$preco = number_format($as->getPreco(), 2, ",", ".");
					$total += $as->getPreco();
					echo "<tr> <td colspan = '3'> $tipo </td> <td colspan = '2' align='center'> R$ $preco </td> </tr>";
				}
			?>
			</tr>
			<?php
				$total = number_format($total, 2, ",", ".");
				echo "<tr bgcolor='#FA8072'> <td colspan = '3'> Total = </td> <td colspan = '2' align='center'> R$ $total </td> </tr>";
			?>
			<tr>
			</tr>
			<tr>
				<td colspan = '5' bgcolor='0099CC' align='center'> <Strong>Detalhamento de produtos utilizados </strong> </td>
			</tr>
			<tr bgcolor='0099CC' align='center'>
				<td> <strong>Código de barras</strong> </td>
				<td colspan = "2" > <strong>Descrição do Produto</strong> </td>
				<td colspan = "2" > <strong>Quantidade</strong> </td>				
			</tr>
			<?php
				if (empty($saida)){
					echo "<tr> <td colspan = '5' align ='center'> Não foram utilizados produtos para realização deste serviço </td> </tr>";
				} 
				else {
					foreach ($saida as $as) {
						$codigo = $as->getProduto()->getId();
						$descricao = $as->getProduto()->getDescricao();
						$qtd = $as->getQtd();
						echo "<tr> <td> $codigo </td> <td colspan = '2'> $descricao </td> <td colspan = '2' align='center'> $qtd </td> </tr>";
					}
				}
			?>
			</tr>
		</table>
	</div>
</div>
<div class="clear"></div> 
</div> 
<div id="footer">
  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
</div>
</body>
</html>