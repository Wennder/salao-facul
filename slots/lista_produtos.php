<?php		
	include_once('../verificar_logado.php');
	require_once('../include_dao.php');
	
	$param = $_GET['param'];
	$produtos = DAOFactory::getProdutoDAO()->queryByDescricao("%$param%");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

	<?php if (sizeof($produtos) == 0) 
	{
		echo "<div style=\"height: 100px; text-align: center; padding: 11px; font-size: 12px;\">";
		echo "<span>Sem resultados para <strong>$param</strong></span>";
		echo "</div>";
	}
	else 
	{
	?>
	<table id="lista" class="table table-hover" style="width: 100%">
		<tr>
			<th>Produto</th>
			<th>Estoque</th>
			<th>Valor unitário</th>
			<th>Marca</th>
			<th></th>
		</tr>
		<?php 
			foreach ($produtos as $d) {
				echo "<tr>";
				echo "<td> $d->descricao </td>";
				echo "<td> $d->qtdeEstoque </td>";
				echo "<td> $d->valorUnitario </td>";
				echo "<td> $d->marca </td>";
				echo "<td><button class=\"btn\">Editar</button>";
				echo "<input type=\"hidden\" value=\"$d->id\" /></td>";
				echo "</tr>";
			}
		?>
	</table>
	<script type="text/javascript">
		$("#lista :button").click(function(){
			var id = $(event.target).next().val();
			setConteudo("slots/cad_produto.php?id="+id);
		});
	</script>
	<?php 
	}
	?>
	
</body>
</html>
