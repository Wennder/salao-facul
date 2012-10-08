
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



