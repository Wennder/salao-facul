<?php
	require_once('include_dao.php');
	require_once('status.php');
	
	session_start();
	
	$username = mysql_escape_string($_POST['username']);
	$senha = mysql_escape_string($_POST['senha']);
	
	if (strcmp(trim($username), '') == 0) {
		echo json_encode(new Status('erro', 'Informe seu nome de usuário'));
		return;
	}
	
	if (strcmp(trim($senha), '') == 0) {
		echo json_encode(new Status('erro', 'Informe sua senha'));
		return;
	}
	
	$msg_erro = 'Usu&#225;rio ou senha inv&#225;lidos';
	
	$user = DAOFactory::getClienteDAO()->queryByUsername($username);
	if (!$user[0]) {
		echo json_encode(new Status('erro', $msg_erro));
	} else {
		if (strcmp($user[0]->senha, $senha)== 0) {
			$_SESSION['user'] = $user[0]; //seta o usuário que acabou de logar da session
			echo json_encode(new Status('ok', $user[0]->username));
		} else {
			echo json_encode(new Status('erro', $msg_erro));
		}
	}
?>