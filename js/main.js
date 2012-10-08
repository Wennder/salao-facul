
$(document).ready(function(){
	$("#nav").find("a").click(function(){
		$("#nav").find("li").removeClass("active");
		$(event.target).parent().addClass("active");
	});
	
	setConteudo("slots/agenda.php");
	
});

function submitForm(nextcontent) {
	var jid='#'+$(event.target).closest("form").attr('id');
	if (!$(jid).valid())
		return false;
	
	var data = $(jid).find("select, input").serialize(); // Dados do formulário   
	var load = $(jid).find('.loading');
	if (load)
		load.html('<img src="img/ajax-loader.gif" />');
        // Envia o formulário via Ajax
        $.ajax({
                type: 'POST',
                url: $(jid).attr('action'),
                data: data,
                success: function(json)
                {
                   load.empty();
                   var status = eval('(' + json + ')');
				   if (status.tipo == 'ok') {
					   if (nextcontent)
						   setConteudo(nextcontent);
					   noty({layout: 'center', type: 'success', text: status.info});
				   }
				   else {
					   noty({layout: 'center', type: 'error', text: status.info});
				   }
				   
                },
                error:function(XMLHttpRequest, textStatus, errorThrown)
                {
                	load.empty();
                	noty({layout: 'center', type: 'error', text: errorThrown});
                }
        });
        return false; // Previne o form de ser enviado pela forma normal
}
            

function checkEnter(e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return false;

	if (keycode == 13) {
	  return true;
	}
	else
	  return false;
}

function setConteudo(pagina, slot) {
	if (!slot)
		slot = 'conteudo';
	
	$('#'+slot).empty();
	$.ajax({
		type: "GET",
		url: pagina,
	
		success: function(data){
			$('#'+slot).html(data); 	
		}
	});
}

function criarAgenda() {
	var agenda = $("#agenda");
	agenda.empty();
	var now = new Date();
	var dia = now.getDate();
	var count = dia + 6;
	agenda.append("<table class=\"table table-bordered\"><thead><tr><th></th></tr></thead><tbody></tdoby>");
	for (var i=dia; i<count; i++) {
		agenda.find("thead tr").append("<th>" + dayToStr(now.getDay()) + " " + (dia++) + "/" + now.getMonth()+1 + "</th>");
		now.setDate(i+1);
		if (now.getDay() == 0) {
			now.setDate(i+2);
			i++;
			count++;
			dia++;
		}
	}
	
	for (var i=7; i<21; i++) {
		agenda.find("tbody").append("<tr><td>"+ formatHora(i) +"</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
	}
	
}

function dayToStr(day) {
	switch (day) {
	case 0:
		return "Dom";
	case 1:
		return "Seg";
	case 2:
		return "Ter";
	case 3:
		return "Qua";
	case 4:
		return "Qui";
	case 5:
		return "Sex";
	case 6:
		return "Sab";
	default:
		return "";
	}
}

function formatHora(hora){
	return (hora < 10 ? "0" + hora + ":00" : hora + ":00");
} 



