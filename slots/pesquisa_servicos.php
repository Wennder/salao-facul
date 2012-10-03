<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div style="margin: auto; width: 400px;">
	<div sytle="height: 37px">
	<button class="btn btn-primary" onclick="javascript:setConteudo('slots/cad_servico.html');">Novo serviço</button>
	<input id="search" type="text" class="input-small" style="float: right; width: 150px;" placeholder="Pesquisar">
	</div>
	<div id="pesquisa">
	
	</div>
	</div>
	
<script type="text/javascript">
	setConteudo('slots/lista_servicos.php', 'pesquisa');
	$('#search').keypress(function () {
		if (checkEnter(event)) {
			setConteudo('slots/lista_servicos.php?param=' + $('#search').val(), 'pesquisa');
		}
	});
</script>
</body>
</html>
