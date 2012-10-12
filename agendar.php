<?php
	require_once('include_dao.php');
	require_once('status.php');
	session_start();
	
	$transaction = new Transaction();

	$user = $_SESSION["user"];
	
	$agendamento = new Agendamento();
	$agendamento->clienteId = $user->id;
	$agendamento->dia = $_POST["dia"];
	$agendamento->inicio = $_POST["horario"];
	
	
	try {
		DAOFactory::getAgendamentoDAO()->insert($agendamento);
		
		$servicos = json_decode($_POST["servicos"]);
		for ($i=0; $i<sizeof($servicos); $i++) {
			$s = DAOFactory::getServicoDAO()->queryByDescricao($servicos[$i]->descricao);
			$as = new AgendamentoServico();
			$as->idAgendamento = $agendamento->id;
			$as->idServico = $s[0]->id;
			DAOFactory::getAgendamentoServicoDAO()->insert($as);
			$horas += $s[0]->horas;
		}
		
		$agendamento->duracao = $horas;
		DAOFactory::getAgendamentoDAO()->update($agendamento);
		
		$split = split(":", $agendamento->inicio);
		$duracao = intval($split[0]) + $horas;
		$info = ($duracao < 10 ? "0" . $duracao : $duracao) . ":00";
		
		$transaction->commit();
		echo json_encode(new Status('ok', "agendado das $agendamento->inicio  às  $info"));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>