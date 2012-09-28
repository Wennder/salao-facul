<?php		
	include_once('verificar_logado.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
        "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>	

<div id="topo">
<h1>Salão da Leda</h1>
</div>

<div id="tudo">

<div id="nav">
<ul>
	<li><a id="linkLicenca" href="javascript:setConteudo('slots/cad_funcionario.html');">Cadastro de funcionário</a></li>
	<li><a id="linkConsulta" href="javascript:setConteudo('slots/cad_produto.html');">Cadastro de produto</a></li>
	<li><a id="linkSair" href="logout.php">Sair<?php echo ' <span style="color: gray;">(' . $_SESSION['user']->username . ')</span>'?></a></li>
</ul>
</div>

<div id="conteudo">	
</div>

<div id="rodape">
...
</div>

</div>

<script src="js/jquery-1.4.4.min.js" type="text/javascript"></script>  
<script src="js/jquery.validate.min.js" type="text/javascript"></script>  
<script src="js/main.js" type="text/javascript"></script>

		
</body>
</html>
