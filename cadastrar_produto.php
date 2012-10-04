<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();

	$prod = (object)$_POST;
	
	try {
		if (is_numeric($prod->id))
			DAOFactory::getProdutoDAO()->update($prod);
		else
			DAOFactory::getProdutoDAO()->insert($prod);
		$transaction->commit();
		echo json_encode(new Status('ok', $prod->descricao .' cadastrado com sucesso!'));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>