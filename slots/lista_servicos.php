<?php		
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
		if ($param != null || !empty($param))
			echo "<span>Sem resultados para <strong>$param</strong></span>";
		else
			echo "<span>Nenhum serviço cadastrado ainda!</span>";
		echo "</div>";
	}
	else 
	{
	?>
	<table id="lista" class="table table-hover" style="width: 100%">
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
				echo "<td><button class=\"btn\">Editar</button>";
				echo "<input type=\"hidden\" value=\"$s->id\" /></td>";
				echo "</tr>";
			}
		?>
	</table>
	<script type="text/javascript">
		$("#lista :button").click(function(){
			var id = $(event.target).next().val();
			setConteudo("slots/cad_servico.php?id="+id);
		});
	</script>
	<?php 
	}
	?>
	
</body>
</html>
