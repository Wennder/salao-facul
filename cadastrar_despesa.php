<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();
	
	$desp = (object)$_POST;

	try {
		if (is_numeric($desp->id))
			DAOFactory::getDespesaDAO()->update($desp);
		else
			DAOFactory::getDespesaDAO()->insert($desp);
		$transaction->commit();
		echo json_encode(new Status('ok', 'Despesa salva com sucesso!'));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>