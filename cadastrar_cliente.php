<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();

	$user = new Cliente();
	$user->nome = mysql_escape_string($_POST['nome']);
	$user->username = mysql_escape_string($_POST['username']);
	$user->senha = mysql_escape_string($_POST['senha']);
	
	try {
		DAOFactory::getClienteDAO()->insert($user);
		$transaction->commit();
		echo json_encode(new Status('ok', $user->nome .' salvo com sucesso!'));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>