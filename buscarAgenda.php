<?php 
	require_once('verificar_logado.php');
	require_once('include_dao.php');
	
	$sem = $_GET["sem"];
	
	$ini = new DateTime();
	if ($sem > 0)
		$ini->add(new DateInterval("P$semD"));
	
	$fim = clone $ini;

	$fim->add(new DateInterval("P7D"));
	$mysqini = $ini->format("Y-m-d");
	$mysqfim = $fim->format("Y-m-d");
	
	$agenda = DAOFactory::getAgendamentoDAO()->queryBetweenDatas($mysqini, $mysqfim);
	echo json_encode($agenda);

?>