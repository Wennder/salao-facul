<?php		
	require_once('../include_dao.php');
	
	$param = $_GET['param'];
	$clientes = DAOFactory::getClienteDAO()->queryByNome("%$param%");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

	<?php if (sizeof($clientes) == 0) 
	{
		echo "<div style=\"height: 100px; text-align: center; padding: 11px; font-size: 12px;\">";
		if ($param != null || !empty($param))
			echo "<span>Sem resultados para <strong>$param</strong></span>";
		else
			echo "<span>Nenhum cliente cadastrado ainda!</span>";
		echo "</div>";
	}
	else 
	{
	?>
	<table id="lista" class="table table-hover" style="width: 100%">
		<tr>
			<th>Cliente</th>
			<th>Celular</th>
			<th>Endereço</th>
			<th></th>
		</tr>
		<?php 
			foreach ($clientes as $c) {
				echo "<tr>";
				echo "<td> $c->nome </td>";
				echo "<td> $c->celular </td>";
				echo "<td> $c->endereco </td>";
				echo "<td><button class=\"btn\">Editar</button>";
				echo "<input type=\"hidden\" value=\"$c->id\" /></td>";
				echo "</tr>";
			}
		?>
	</table>
	<script type="text/javascript">
		$("#lista :button").click(function(){
			var id = $(event.target).next().val();
			setConteudo("slots/cad_cliente.php?id="+id);
		});
	</script>
	<?php 
	}
	?>
	
</body>
</html>
