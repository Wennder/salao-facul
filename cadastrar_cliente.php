<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();

	$user = new Cliente();
	$user->nome = mysql_escape_string($_POST['nome']);
	$user->username = mysql_escape_string($_POST['username']);
	$user->senha = mysql_escape_string($_POST['senha']);
	
	DAOFactory::getClienteDAO()->insert($user);
	
	$transaction->commit();

?>