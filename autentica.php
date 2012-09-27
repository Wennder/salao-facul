<?php
	require_once('include_dao.php');
	require_once('status.php');
	
	session_start();
	
	$username = mysql_escape_string($_POST['username']);
	$senha = mysql_escape_string($_POST['senha']);
	
	$status = new Status;
	
	if (strcmp(trim($username), '') == 0) {
		$status->tipo = 'erro';
		$status->info = 'Informe seu nome de usu&#225;rio';
		echo json_encode($status);
		return;
	}
	
	if (strcmp(trim($senha), '') == 0) {
		$status->tipo = 'erro';
		$status->info = 'Informe sua senha';
		echo json_encode($status);
		return;
	}
	
	$msg_erro = 'Usu&#225;rio ou senha inv&#225;lidos';
	
	$user = DAOFactory::getUsuarioDAO()->queryByUsername($username);
	if (!$user[0]) {
		$status->tipo = 'erro';
		$status->info = $msg_erro;
		echo json_encode($status);
	} else {
		if (strcmp($user[0]->senha, $senha)== 0) {
			$_SESSION['user'] = $user[0]; //seta o usuário que acabou de logar da session
			$status->tipo = 'ok';
			$status->info = $user[0]->username;
			echo json_encode($status);
		} else {
			$status->tipo = 'erro';
			$status->info = $msg_erro;
			echo json_encode($status);
		}
	}
?>