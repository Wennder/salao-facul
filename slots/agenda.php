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
	criarAgenda();
    
	$("#agenda").find("td").popover({ 
	    html : true,
	    trigger: "manual",
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