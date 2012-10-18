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
		
		$ags = DAOFactory::getAgendamentoDAO()->queryByDia($agendamento->dia);
		$split = split(":", $agendamento->inicio);
		$h = intval($split[0]);
		$m = intval($split[1]);
		for ($i=1; $i<($horas/0.5); $i++) {
			if ($m == 30) {
				$h++;
				$m = 0;
			}
			else 
				$m = 30;
			$horas_verificar[] =  ($h < 10 ? "0" . $h : $h) . ":" . ($m < 10 ? "0" . $m : $m);
		}
		
		$overflow = split(":", $horas_verificar[sizeof($horas_verificar)-1]);
		if (intval($overflow[0]) > 20 || (intval($overflow[0]) == 20 && intval($overflow[1]) == 30) ) {
			$transaction->rollback();
			echo json_encode(new Status("erro", "O horário agendado passa das 20:00"));
			return;
		}
		
		
		for ($i=0; $i<sizeof($ags); $i++) {
			$a = $ags[$i];
			for ($j=0; $j<sizeof($horas_verificar); $j++) {
				if ($a->inicio == $horas_verificar[$j]) {
					$transaction->rollback();
					echo json_encode(new Status("erro", "Não dá!"));
					return;
				}
			}
		}
			
		$agendamento->duracao = $horas;
		DAOFactory::getAgendamentoDAO()->update($agendamento);
		
/*		$split = split(":", $agendamento->inicio);
		$duracao = intval($split[0]) + $horas;
		$info = ($duracao < 10 ? "0" . $duracao : $duracao) . ":00"; */
		
		$transaction->commit();

		$agendamento->nomeCliente = $user->nome;
		echo json_encode(new Status('ok', json_encode($agendamento)));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>