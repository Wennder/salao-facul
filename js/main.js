var servicos;
var navigator_value = 0;
var isLogado;
var isAdmin;
var agendamento_color = "rgb(255, 0, 0)";

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
	$("#anterior").attr("disabled", semana <= 0);
	
	$.ajax({
        type: 'GET',
        url: "buscarAgenda.php?sem="+semana,
        success: function(json)
        {
	       	var agenda = $("#agenda");
	       	agenda.empty();
	       	var now = new Date();
	       	now.setDate(now.getDate() + (7 * semana));
	       	var count = 6;
	       	agenda.append("<table class=\"table table-bordered\"><thead><tr><th></th></tr></thead><tbody></tdoby>");
	       	for (var i=0; i<count; i++) {
	       		if (now.getDay() == 0) {
	       			now.setDate(now.getDate()+1);
	       			count++;
	       			continue;
	       		}
	       		
	       		var th = $("<th>" + dayToStr(now.getDay()) + " " + (now.getDate()) + "/" + (now.getMonth()+1) + "</th>").appendTo(agenda.find("thead tr"));
	       		$.data(th, "dia", now);
	       		now.setDate(now.getDate()+1);
	       	}
	       	
	       	for (var i=7; i<21; i++) {
	       		var h1 = formatHora3(i);
	       		agenda.find("tbody").append("<tr><td>"+ h1 +"</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
	       		if (i!=20) {
	       			var h2 = h1.replace("00", "30");
	       			agenda.find("tbody").append("<tr><td>"+ h2 +"</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
	       		}
	       	}
	       	
	       	agenda.find("thead tr ::first-child").next().addClass("background-destacado");
	       	agenda.find("tbody tr ::first-child").next().addClass("background-destacado");
	       	
	       	$("#agenda").find("td").popover({ 
	    	    html : true,
	    	    trigger: "manual",
	    	    placement: "bottom",
	    	    template: '<div class="popover agendamento"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>',
	    	    content: function() {
	    	    	if (!isLogado) {
	    	    		location.href = "login.php";
	    	    		return;
	    	    	}
	    	    	
	    	    	if (!isAdmin && ($(this).css("background-color") == agendamento_color)) {
	    	    		noty({layout: 'center', type: 'warning', text: "Já existe um agendamento neste horário!"});
	    	    		return;
	    	    	}
	    	    	
	    	    	if (isAdmin && ($(this).css("background-color") != agendamento_color)) {
	    	    		return;
	    	    	}
	    	    	
	    	    	var dia = getDataFromTD(this);
	    	     	return getFormAgendar(dia);
	    	    }
	       		
	    	  });

	    	$("#agenda").find("td").filter(function(){
	    		var th = $(this).closest('table').find('th').eq($(this).index());
	    		return $(th).index() > 0; 
	    	}).click(function(){
	    		$("#agenda").find("td").popover("hide");
	    		var td = this;
	    		setTimeout(function() {
	    			if (isAdmin && ($(td).css("background-color") == agendamento_color)) {
	    	    		var td1 = td;
	    	    		while ($(td1).html() == "") {
	    	    			var tr = $(td1).parent();
	    	    			td1 = tr.prev().children().eq($(td1).index());
	    	    		}
	    	    		
	    	    		var data = getDataFromTD(td1);
	    	    		var dia = data.getFullYear() + "-" + (data.getMonth()+1) + "-" + data.getDate();
	    	    		var hora = formatHora(data);
	    	    		
	    	    		$.ajax({
	    	    			type: "GET",
	    	    			url: "buscarAgendamento.php?dia="+dia+"&hora="+hora,
	    	    		
	    	    			success: function(json){
	    	    				var ag = eval('(' + json + ')');
	    	    				$(td).popover("show");
	    	    				setTimeout(function() {
	    	    					for (var i=0; i<ag.servicos.length; i++) {
	    	    						 addServicoNoAgendamento(ag.servicos[i].descricao);
	    	    					}
	    	    				}, 300);
	    	    			}
	    	    		});
	    	    		
	    	    	}
	    			else
	    				$(td).popover("show");
	    		}, 500);
	    		
	    	});

	    	$("#agenda").find("td").filter(function(){
	    		var th = $(this).closest('table').find('th').eq($(this).index());
	    		return $(th).index() == 0; 
	    	}).css("width", "20px");
	    	
	    	var age = eval('(' + json + ')');
	    	for (var i=0; i<age.length; i++) {
	    		marcarAgendamento(age[i]);
	    	}

        },
        error:function(XMLHttpRequest, textStatus, errorThrown)
        {
        	load.empty();
        	noty({layout: 'center', type: 'error', text: errorThrown});
        }
	});

}

function getDataFromTD(td) {
	var th = $(td).closest('table').find('th').eq($(td).index());
  	var index = $(th).index();
  	var dia = new Date();
  	var diff = (dia.getDate()+index-1)-dia.getDate();
  	var inc = (diff+dia.getDay()) > 6 ? 1 : 0 ;
  	dia.setDate(dia.getDate() + inc);
  	dia.setDate(dia.getDate() + diff);
  	var split = $(td).parent().find(":first").text().split(":");
  	var hora = split[0];
  	var min = split[1];
  	dia.setHours(hora);
  	dia.setMinutes(min);
  	dia.setDate(dia.getDate() + (7 * navigator_value));
  	return dia;
}

function marcarAgendamento(agendamento) {
	var split = agendamento.dia.split("-");
	var ano = split[0];
	var mes = split[1] - 1;
	var dia = split[2];
	
	split = agendamento.inicio.split(":");
	var hora = split[0];
	var min = split[1];
	
	var data = new Date();
	data.setFullYear(ano);
	data.setMonth(mes);
	data.setDate(dia);
	data.setHours(hora);
	data.setMinutes(min);
	
	var cr = getLinhaColuna(data);
	var coluna = cr.split(",")[0];
	var linha = cr.split(",")[1];
	var linhas = parseInt(coluna) + (agendamento.duracao / 0.5);
	
	for (var j=coluna; j<linhas; j++) {
		var td = $("#agenda tr:eq("+j+") td:eq("+linha+")");
		td.css("background-color", agendamento_color);
		if (j == coluna) {
			td.html(agendamento.nomeCliente);
		}
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

function formatHora(data){
	var m = data.getMinutes();
	m = m > 0 ? 30 : 0;
	var hora = data.getHours();
	var min = (m < 10 ? "0" + m : m);
	return (hora < 10 ? "0" + hora + ":" + min : hora + ":" + min);
}

function formatHora3(hora){
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
	return dayToStr(data.getDay()) + ", " + dia + " de " + mes + ", " + formatHora(data) ;
}

function getFormAgendar(dia) {
	var select = "<div class=\"input-append\"><select id=\"servico\" style=\"width: 260px;\">";
	for (var i=0; i<servicos.length; i++) {
		select += "<option>" + servicos[i].descricao + "</option>";
	}
	select += "</select><button class=\"btn\" onclick=\"addServicoNoAgendamento();\">+</button></div>";
	
	var data = dia.getFullYear() + "-" + (dia.getMonth()+1) + "-" + dia.getDate();
	var horario = formatHora(dia);
	
	var html = 
				"<div id=\"agendamento\">" +
					"<form onsubmit=\"return false;\"><table style=\"width: 100%;\">";
	if (!isAdmin) {
		html +=
						"<tr><td>" +
						"<label>Horário</label>" +
						"<div class=\"input-append\">" +
						"<input type=\"text\" value=\"" + formatData(dia) + "\" style=\"width: 240px;\" readonly=\"readonly\"/>" +
						"</div>" +
						"</td><td>" + 
						"<label>O que deseja fazer?</label>" +
						select +
						"</td></tr>";
	}
	
	html += 			"<tr><td colspan=\"2\">" +
						"<div id=\"servicos_escolhidos\"><table class=\"table\" >" +
						"</table></div>" +
						"</td></tr></table>" +
						"<div>";
	if (!isAdmin) {
		html += "<button style=\"float: right;\" class=\"btn\" onclick=\"fecharPopovers();\">Cancelar</button>" +
				"<button style=\"float: right;\" class=\"btn btn-primary\" onclick=\"agendar('" + data + "', '"+ horario +"')\">Agendar</button>";
	}
	
	html +=			"</div>" +
					"</form>" +
				"</div>";
	return html;
}

function addServicoNoAgendamento(serv) {
	if (serv == null)
		serv = $("#servico").val();
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
		var html = "<tr><td style=\"width: 90%;\"><span>" + serv + "</span></td>";
		if (!isAdmin) {
			html += "<td><a class=\"btn\">x</a></td>";
		}
		
		html += "</tr>";
		
		table.append(html);
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
				   noty({layout: 'center', type: 'success', text: 'Agendado!'});
				   var g = eval('(' + status.info + ')');
				   marcarAgendamento(g);
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

function getLinhaColuna(data) {	
	var col = -1;
	switch (data.getHours()) {
	case 7:
		col =  data.getMinutes() == 0 ? 1 : 2;
		break;
	case 8:
		col =  data.getMinutes() == 0 ? 3 : 4;
		break;
	case 9:
		col =  data.getMinutes() == 0 ? 5 : 6;
		break;
	case 10:
		col =  data.getMinutes() == 0 ? 7 : 8;
		break;
	case 11:
		col =  data.getMinutes() == 0 ? 9 : 10;
		break;
	case 12:
		col =  data.getMinutes() == 0 ? 11 : 12;
		break;
	case 13:
		col =  data.getMinutes() == 0 ? 13 : 14;
		break;
	case 14:
		col =  data.getMinutes() == 0 ? 15 : 16;
		break;
	case 15:
		col =  data.getMinutes() == 0 ? 17 : 18;
		break;
	case 16:
		col =  data.getMinutes() == 0 ? 19 : 20;
		break;
	case 17:
		col =  data.getMinutes() == 0 ? 21 : 22;
		break;
	case 18:
		col =  data.getMinutes() == 0 ? 23 : 24;
		break;
	case 19:
		col =  data.getMinutes() == 0 ? 25 : 26;
		break;
	case 20:
		col =  data.getMinutes() == 0 ? 27 : 28;
		break;
	default:
		break;
	}
	
	var hoje = new Date();
	hoje.setDate(hoje.getDate()+navigator_value*7);
	if (hoje.getDay() == 0)
		hoje.setDay(hoje.getDay() + 1);
	
	var row = 0;
	if (data.getDay() == hoje.getDay())
		row = 1;
	else {
		hoje.setDate(hoje.getDate()+1);
		if (hoje.getDay() == 0)
			hoje.setDate(hoje.getDate() + 1);
		if (data.getDay() == hoje.getDay())
			row = 2;
		else {
			hoje.setDate(hoje.getDate()+1);
			if (hoje.getDay() == 0)
				hoje.setDate(hoje.getDate() + 1);
			if (data.getDay() == hoje.getDay())
				row = 3;
			else {
				hoje.setDate(hoje.getDate()+1);
				if (hoje.getDay() == 0)
					hoje.setDate(hoje.getDate() + 1);
				if (data.getDay() == hoje.getDay())
					row = 4;
				else {
					hoje.setDate(hoje.getDate()+1);
					if (hoje.getDay() == 0)
						hoje.setDate(hoje.getDate() + 1);
					if (data.getDay() == hoje.getDay())
						row = 5;
					else {
						hoje.setDate(hoje.getDate()+1);
						if (hoje.getDay() == 0)
							hoje.setDate(hoje.getDate() + 1);
						if (data.getDay() == hoje.getDay())
							row = 6;
					}
				}
			}
		}
	}
	
	
	return col + "," + row;
}



