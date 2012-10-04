<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();
	
	$serv = (object)$_POST;

	try {
		if (is_numeric($serv->id))
			DAOFactory::getServicoDAO()->update($serv);
		else
			DAOFactory::getServicoDAO()->insert($serv);
		$transaction->commit();
		echo json_encode(new Status('ok', 'Serviço salvo com sucesso!'));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>