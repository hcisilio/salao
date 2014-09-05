<?php
	//session_start();
	include_once("../conexao.php");
	include_once("../Classes/classeAtendimentoServico.php");
	include_once("classeServicoSQL.php");
	
	class AtendimentoServicoSQL {
		
		var $sql;
		
		function inserir($atendServ){
			$this->sql = "insert into atendimento_servico values (
			'".$atendServ->getAtendimento()->getId()."',
			'".$atendServ->getServico()->getId()."',
			'".$atendServ->getDesconto()."',
			'".$atendServ->getPreco()."'
			)";
			mysql_query($this->sql);			
			return true;
		}
		
		function listarPorAtendimento($atendimento){
			$this->sql = "select * from atendimento_servico ats, servico s where ats.atendimento = $atendimento and ats.servico = s.id";
			$query = mysql_query($this->sql);
			$atendimentoServicoArr = array();
			while ($linha=mysql_fetch_array($query)){
				$servico = new ServicoSQL();
				$atendimentoServico = new atendimentoServico();
				$atendimentoServico->setAtendimento($linha["atendimento"]);
				$atendimentoServico->setServico($servico->listar($linha["servico"]));
				$atendimentoServico->setDesconto($linha["desconto"]);
				$atendimentoServico->setPreco($linha["preco"]);
				$atendimentoServicoArr[] = $atendimentoServico;
				unset($atendimentoServico);
			}
			return $atendimentoServicoArr;
		}
	}
?>
