<?php 
	require_once('include_dao.php');
	date_default_timezone_set('America/Sao_Paulo');
	
	$dia = $_GET["dia"];
	$hora = $_GET["hora"];
	
	$agenda = DAOFactory::getAgendamentoDAO()->queryByDiaHora($dia, $hora);
	$servs = DAOFactory::getServicoDAO()->queryByAgendamento($agenda->id);
	$agenda->servicos = $servs;
	echo json_encode($agenda);

?>