<?php		
	include_once('../verificar_logado.php');
	require_once('../include_dao.php');
	
	$param = $_GET['param'];
	$vendas = DAOFactory::getVendaDAO()->queryByParam($param);
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

	<?php if (sizeof($vendas) == 0) 
	{
	echo "<div style=\"height: 100px; text-align: center; padding: 11px; font-size: 12px;\">";
		if ($param != null || !empty($param))
			echo "<span>Sem resultados para <strong>$param</strong></span>";
		else
			echo "<span>Nenhum venda cadastrada ainda!</span>";
		echo "</div>";
	}
	else 
	{
	?>
	<table id="lista" class="table table-hover" style="width: 100%">
		<tr>
			<th>Data</th>
			<th>Cliente</th>
			<th>Total</th>
			<th>Total pago</th>
		</tr>
		<?php 
			foreach ($vendas as $s) {
				$c = DAOFactory::getClienteDAO()->load($s->clienteId);
				echo "<tr>";
				echo "<td> $s->data </td>";
				echo "<td> $c->nome </td>";
				echo "<td> $s->total </td>";
				echo "<td> $s->totalPago </td>";
				echo "<td><button class=\"btn\">Editar</button>";
				echo "<input type=\"hidden\" value=\"$s->id\" /></td>";
				echo "</tr>";
			}
		?>
	</table>
	<script type="text/javascript">
		$("#lista :button").click(function(){
			var id = $(event.target).next().val();
			setConteudo("slots/cad_venda.php?id="+id);
		});
	</script>
	<?php 
	}
	?>
	
</body>
</html>
