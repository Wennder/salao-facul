<?php		
	include_once('../verificar_logado.php');
	require_once('../include_dao.php');
	
	$param = $_GET['param'];
	$funcionarios = DAOFactory::getFuncionarioDAO()->queryByNome("%$param%");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

	<?php if (sizeof($funcionarios) == 0) 
	{
		echo "<div style=\"height: 100px; text-align: center; padding: 11px; font-size: 12px;\">";
		if ($param != null || !empty($param))
			echo "<span>Sem resultados para <strong>$param</strong></span>";
		else
			echo "<span>Nenhum funcionário cadastrado ainda!</span>";
		echo "</div>";
	}
	else 
	{
	?>
	<table id="lista" class="table table-hover" style="width: 100%">
		<tr>
			<th>Funcionário</th>
			<th>Cargo</th>
			<th>Telefone</th>
			<th></th>
		</tr>
		<?php 
			foreach ($funcionarios as $f) {
				echo "<tr>";
				echo "<td> $f->nome </td>";
				echo "<td> $f->cargo </td>";
				echo "<td> $f->telefone </td>";
				echo "<td><button class=\"btn\">Editar</button>";
				echo "<input type=\"hidden\" value=\"$f->id\" /></td>";
				echo "</tr>";
			}
		?>
	</table>
	<script type="text/javascript">
		$("#lista :button").click(function(){
			var id = $(event.target).next().val();
			setConteudo("slots/cad_funcionario.php?id="+id);
		});
	</script>
	<?php 
	}
	?>
	
</body>
</html>
