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
	criarAgenda();
    
	$("#agenda").find("td").popover({ 
	    html : true,
	    trigger: "manual",
	    template: '<div class="popover agendamento"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>',
	    content: function() {
	    	var th = $(this).closest('table').find('th').eq($(this).index());
	      	var index = $(th).index();
		  	var dia = new Date();
		  	var diff = (dia.getDate()+index-1)-dia.getDate();
		  	var inc = (diff+dia.getDay()) > 6 ? 1 : 0 ;
		  	dia.setDate(dia.getDate() + inc);
		  	dia.setDate(dia.getDate() + diff);
		  	var hora = $(this).parent().find(":first").text().split(":")[0];
		  	dia.setHours(hora);
	     	return getFormAgendar(dia);
	    }
	  });

	$("#agenda").find("td").filter(function(){
		var th = $(this).closest('table').find('th').eq($(this).index());
		return $(th).index() > 0; 
	}).click(function(){
		$("#agenda").find("td").popover("hide");
		$(this).popover("show");
	});
	
</script>
</body>
</html>