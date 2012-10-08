<?php		
	//include_once('verificar_logado.php');
	require_once('include_dao.php');
	
	session_start();
	$user = $_SESSION['user'];
	$isAdmin = $user != null && $user->admin;
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
        "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>	

<div id="topo">
<div style="float: left; height: 100%; text-align: center;"><span>Salão da Leda</span></div>
<div style="float: right;">
	<?php 
	if ($isAdmin) {
	?>
	<button class="btn" onclick="javascript:setConteudo('slots/configuracoes_sistema.php');" >Configurações</button>
	<?php 
	}
	?>
	
</div>
</div>

<div id="tudo">

<div id="nav">
<ul class="nav nav-tabs nav-stacked">
	<?php 
	if ($user != null) {
	?>
	<li class="active"><a href="javascript:setConteudo('slots/agenda.php');">Agenda</a></li>
	<?php 
	}
	?>
	
	<?php 
	if ($isAdmin) {
	?>
	<li><a href="javascript:setConteudo('slots/pesquisa_servicos.php');">Serviços</a></li>
	<li><a href="javascript:setConteudo('slots/pesquisa_clientes.php');">Clientes</a></li>
	<li><a href="javascript:setConteudo('slots/pesquisa_funcionarios.php');">Funcionários</a></li>
	<li><a href="javascript:setConteudo('slots/pesquisa_produtos.php');">Produtos</a></li>
	<li><a href="javascript:setConteudo('slots/cad_despesa.php');">Despesas</a></li>
	<?php 
	}
		
	if ($user != null) {
	?>
	<li><a href="logout.php">Sair<?php echo ' <span style="color: gray;">(' . $user->username . ')</span>'?></a></li>
	<?php 
	}
	?>
	
</ul>
</div>

<div id="conteudo">	
</div>

<div id="rodape">
...
</div>

</div>

<script src="js/jquery-1.7.2.js" type="text/javascript"></script>  
<script src="js/jquery.validate-BR.js" type="text/javascript"></script>
<script src="js/noty/jquery.noty.js" type="text/javascript"></script>
<script src="js/noty/themes/default.js" type="text/javascript"></script>  
<script src="js/bootstrap.min.js"></script>
<script src="js/noty/layouts/center.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>

		
</body>
</html>
