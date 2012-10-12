<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();
	
	$nome_cli = $_POST['cliente'];
	$itens = json_decode($_POST['itens']);
	
	$cliente = DAOFactory::getClienteDAO()->queryByNome($nome_cli);
	$venda = new Venda();
	$venda->id = $_POST["id"];
	$now = new DateTime();
	if (!$venda->data)
		$venda->data = $now->format("Y-m-d H:i:s");
	$venda->clienteId = $cliente[0]->id;
	$venda->total = $_POST["total"];
	$venda->totalPago = $_POST["totalpago"];
	
	
	try {
		if (is_numeric($venda->id)) {
			DAOFactory::getVendaDAO()->update($venda);
			DAOFactory::getServicoVendaDAO()->deleteVenda($venda->id);
			DAOFactory::getProdutoVendaDAO()->deleteVenda($venda->id);
		}
		else
			DAOFactory::getVendaDAO()->insert($venda);
		
		$total = 0;
		for ($i=0; $i<sizeof($itens); $i++) {
			$serv = DAOFactory::getServicoDAO()->queryByDescricao($itens[$i]->descricao);
			if ($serv[0] != null) {
				$sv = new ServicoVenda();
				$sv->vendaId = $venda->id;
				$sv->servicoId = $serv[0]->id;
				$sv->qtde = intval($itens[$i]->qtde);
				DAOFactory::getServicoVendaDAO()->insert($sv);
				$total += $serv[0]->valor * $sv->qtde;
				continue;
			}
		
			$prod = DAOFactory::getProdutoDAO()->queryByDescricao($itens[$i]->descricao);
			if ($prod[0] != null) {
				$pv = new ProdutoVenda();
				$pv->vendaId = $venda->id;
				$pv->produtoId = $prod[0]->id;
				$pv->qtde = intval($itens[$i]->qtde);
				DAOFactory::getProdutoVendaDAO()->insert($pv);
				$total += $prod[0]->valorUnitario * $pv->qtde;
			}
		}
		$venda->total = $total;
		DAOFactory::getVendaDAO()->update($venda);
		
		$transaction->commit();
		echo json_encode(new Status('ok', 'Venda salva com sucesso!'));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>