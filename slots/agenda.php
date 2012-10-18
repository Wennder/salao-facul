<?php		
	require_once('../include_dao.php');
	
	session_start();
	$cli = $_SESSION['user'];
	$servs = DAOFactory::getServicoDAO()->queryAll();
	$servs_json = json_encode($servs);
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
	<h4>Agenda</h4>
	<div id="navigator" style="float: right;">
	<button id="anterior" class="btn">Anterior</button>
	<button id="proximo" class="btn">Próximo</button>
	</div>
	<div id="agenda">
		<table class="table">
		</table>
	</div>
	
<script type="text/javascript">
	<?php 
		echo "servicos = eval('(' + '$servs_json' + ')');"; 
	?>;
	criarAgenda(0);

	$("#anterior").click(function() {
		criarAgenda(--navigator_value);
	});

	$("#proximo").click(function() {
		criarAgenda(++navigator_value);
	});
	
    
</script>
</body>
</html>