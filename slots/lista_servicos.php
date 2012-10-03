<?php		
	include_once('../verificar_logado.php');
	require_once('../include_dao.php');
	
	$param = $_GET['param'];
	$servicos = DAOFactory::getServicoDAO()->queryByDescricao("%$param%");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

	<?php if (sizeof($servicos) == 0) 
	{
		echo "<div style=\"height: 100px; text-align: center; padding: 11px; font-size: 12px;\">";
		echo "<span>Sem resultados para <strong>$param</strong></span>";
		echo "</div>";
	}
	else 
	{
	?>
	<table class="table table-hover" style="width: 100%">
		<tr>
			<th>Serviço</th>
			<th>Valor</th>
			<th>Horas</th>
			<th></th>
		</tr>
		<?php 
			foreach ($servicos as $s) {
				echo "<tr>";
				echo "<td> $s->descricao </td>";
				echo "<td> $s->valor </td>";
				echo "<td> $s->horas </td>";
				echo "<td><button class=\"btn\">Editar</button></td>";
				echo "</tr>";
			}
		?>
	</table>
	<?php 
	}
	?>
	
</body>
</html>
