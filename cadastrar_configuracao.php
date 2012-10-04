<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();
	
	$conf = (object)$_POST;

	try {
		if (is_numeric($conf->id))
			DAOFactory::getConfiguracaoDAO()->update($conf);
		else
			DAOFactory::getConfiguracaoDAO()->insert($conf);
		$transaction->commit();
		echo json_encode(new Status('ok', 'Configurações salvas com sucesso!'));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>