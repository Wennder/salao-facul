<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();

	$func = (object)$_POST;
	
	try {
		if (is_numeric($func->id))
			DAOFactory::getFuncionarioDAO()->update($func);
		else
			DAOFactory::getFuncionarioDAO()->insert($func);
		$transaction->commit();
		echo json_encode(new Status('ok', $func->nome .' salvo com sucesso!'));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>