<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();

	$serv = new Servico();
	$serv->descricao = mysql_escape_string($_POST['descricao']);
	$serv->valor = mysql_escape_string($_POST['valor']);
	$serv->horas = mysql_escape_string($_POST['horas']);
	
	try {
		DAOFactory::getServicoDAO()->insert($serv);
		$transaction->commit();
		echo json_encode(new Status('ok', 'Serviço cadastrado com sucesso!'));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>