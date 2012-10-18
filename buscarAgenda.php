<?php 
	require_once('include_dao.php');
	date_default_timezone_set('America/Sao_Paulo');
		
	session_start();
	
	$sem = $_GET["sem"];
	$ini = new DateTime();
	if ($sem > 0) {
		$semana = intval($sem) * 7;
		$ini->add(new DateInterval("P".$semana."D"));
	}
	
	$fim = clone $ini;

	$fim->add(new DateInterval("P7D"));
	$mysqini = $ini->format("Y-m-d");
	$mysqfim = $fim->format("Y-m-d");
	
	$agenda = DAOFactory::getAgendamentoDAO()->queryBetweenDatas($mysqini, $mysqfim);
	for ($i=0; $i<sizeof($agenda); $i++) {
		$a = $agenda[$i];
		$c = DAOFactory::getClienteDAO()->load($a->clienteId);
		$a->nomeCliente = $c->nome;
	}
	
	echo json_encode($agenda);

?>