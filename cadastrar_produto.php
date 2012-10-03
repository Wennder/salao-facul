<?php
	require_once('include_dao.php');
	require_once('status.php');

	$transaction = new Transaction();

	$prod = new Produto();
	$prod->descricao = mysql_escape_string($_POST['descricao']);
	$prod->data = mysql_escape_string($_POST['data']);
	$prod->marca = mysql_escape_string($_POST['marca']);
	$prod->valorUnitario = mysql_escape_string($_POST['valor_unit']);
	$prod->qtdeEstoque = mysql_escape_string($_POST['qtde']);
	$prod->qtdeUltimaCompra = mysql_escape_string($_POST['qtde_ultima_compra']);
	
	try {
		DAOFactory::getProdutoDAO()->insert($prod);
		$transaction->commit();
		echo json_encode(new Status('ok', $prod->descricao .' cadastrado com sucesso!'));
	}catch(exception $e) {
		$transaction->rollback();
		echo json_encode(new Status('erro', $e->getMessage()));
	}
	
?>