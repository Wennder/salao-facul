<?php		
	require_once('../verificar_logado.php');
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
	<div id="agenda">
		<table class="table">
		</table>
	</div>
	
<script type="text/javascript">
	<?php 
		echo "servicos = eval('(' + '$servs_json' + ')');"; 
	?>;
	criarAgenda(0);
    
</script>
</body>
</html>