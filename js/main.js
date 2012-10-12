var servicos;

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

function criarAgenda(semana) {
	$.ajax({
        type: 'GET',
        url: "buscarAgenda.php?sem="+semana,
        success: function(json)
        {
        	//var age = eval('(' + json + ')');
        	
	       	var agenda = $("#agenda");
	       	agenda.empty();
	       	var now = new Date();
	       	var dia = now.getDate();
	       	var count = dia + 6;
	       	agenda.append("<table class=\"table table-bordered\"><thead><tr><th></th></tr></thead><tbody></tdoby>");
	       	for (var i=dia; i<count; i++) {
	       		var th = $("<th>" + dayToStr(now.getDay()) + " " + (dia++) + "/" + (now.getMonth()+1) + "</th>").appendTo(agenda.find("thead tr"));
	       		$.data(th, "dia", now);
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
	       	
	       	agenda.find("thead tr ::first-child").next().addClass("background-destacado");
	       	agenda.find("tbody tr ::first-child").next().addClass("background-destacado");
	       	
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

	    	$("#agenda").find("td").filter(function(){
	    		var th = $(this).closest('table').find('th').eq($(this).index());
	    		return $(th).index() == 0; 
	    	}).css("width", "20px");


        },
        error:function(XMLHttpRequest, textStatus, errorThrown)
        {
        	load.empty();
        	noty({layout: 'center', type: 'error', text: errorThrown});
        }
	});

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

function mesToStr(mes) {
	switch (mes) {
	case 0:
		return "janeiro";
	case 1:
		return "fevereiro";
	case 2:
		return "março";
	case 3:
		return "abril";
	case 4:
		return "maio";
	case 5:
		return "junho";
	case 6:
		return "julho";
	case 7:
		return "agosto";
	case 8:
		return "setembro";
	case 9:
		return "outubro";
	case 10:
		return "novembro";
	case 11:
		return "dezembro";
	default:
		return "";
	}
}

function formatHora(hora){
	return (hora < 10 ? "0" + hora + ":00" : hora + ":00");
}

function formatHora2(hora){
	var h1 = (hora < 10 ? "0" + hora + ":00" : hora + ":00");
	hora++;
	var h2 = (hora < 10 ? "0" + hora + ":00" : hora + ":00");
	return h1 + " - " + h2;
} 

function formatData(data) {
	var dia = data.getDate();
	var mes = mesToStr(data.getMonth());
	dia = (dia < 10 ? "0" + dia : dia);
//	var ano = data.getFullYear();
	return dayToStr(data.getDay()) + ", " + dia + " de " + mes + ", " + formatHora(data.getHours()) ;
}

function getFormAgendar(dia) {
	var select = "<div class=\"input-append\"><select id=\"servico\" style=\"width: 260px;\">";
	for (var i=0; i<servicos.length; i++) {
		select += "<option>" + servicos[i].descricao + "</option>";
	}
	select += "</select><button class=\"btn\" onclick=\"addServicoNoAgendamento();\">+</button></div>";
	
	var data = dia.getFullYear() + "-" + (dia.getMonth()+1) + "-" + dia.getDate();
	var horario = formatHora(dia.getHours());
	
	var html = 
				"<div id=\"agendamento\">" +
					"<form onsubmit=\"return false;\">" +
						"<table><tr><td>" +
						"<label>Horário</label>" +
						"<div class=\"input-append\">" +
						"<input type=\"text\" value=\"" + formatData(dia) + "\" style=\"width: 240px;\" readonly=\"readonly\"/>" +
						"</div>" +
						"</td><td>" + 
						"<label>O que deseja fazer?</label>" +
						select +
						"</td></tr><tr><td colspan=\"2\">" +
						"<div id=\"servicos_escolhidos\"><table class=\"table\"></table></div>" +
						"</td></tr></table>" +
						"<div>" +
						"<button style=\"float: right;\" class=\"btn\" onclick=\"fecharPopovers();\">Cancelar</button>" +
						"<button style=\"float: right;\" class=\"btn btn-primary\" onclick=\"agendar('" + data + "', '"+ horario +"')\">Agendar</button>" +
						"</div>" +
					"</form>" +
				"</div>";
	return html;
}

function addServicoNoAgendamento() {
	var serv = $("#servico").val();
	var table = $("#servicos_escolhidos").find("table");
	var spans = table.find("span");
	var jaTem = false;
	for (var i=0; i<spans.length; i++) {
		if (serv == $(spans[i]).text()) {
			jaTem = true;
			break;
		}
	}
	
	if (!jaTem) {
		table.append("<tr><td><span>" + serv + "</span></td><td><a class=\"btn\">x</a></td></tr>");
		table.find("a").click(function() {
			table.remove($(this).parent().parent().remove());
		});
	}
}

function agendar(data, horario) {
	var spans = $("#servicos_escolhidos").find("table").find("span");
	var json = "[";
	for (var i=0; i<spans.length; i++) {
		json += "{\"descricao\":\"" + $(spans[i]).text() + "\"},";
	}
	
	json = json.substring(0, json.length-1) + "]";
	
	$.ajax({
        type: 'POST',
        url: "agendar.php",
        data: "dia=" + data + "&horario=" + horario + "&servicos=" + json,
        success: function(data)
        {
        	fecharPopovers();
        	var status = eval('(' + data + ')');
			   if (status.tipo == 'ok') {
				   noty({layout: 'center', type: 'success', text: status.info});
			   }
			   else {
				   noty({layout: 'center', type: 'error', text: status.info});
			   }
			   
        },
        error:function(XMLHttpRequest, textStatus, errorThrown)
        {
        	noty({layout: 'center', type: 'error', text: errorThrown});
        }
	});
	return false;
}

function fecharPopovers() {
	 $("#agenda").find("td").popover("hide");
}


