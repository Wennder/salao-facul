
$(document).ready(function(){
//	$("#loading").hide();
//	$("#loading").ajaxStart(function(){
//		$(this).show();
//	});
//	$("#loading").ajaxStop(function(){
//		$(this).hide();
//	}); 
	
});

function submitForm() {
	var jid='#'+$(event.target).closest("form").attr('id');
	if (!$(jid).valid())
		return false;
	
	var data = $(jid).find('input').serialize(); // Dados do formulário   
	var load = $(jid).find('.loading');
	if (load)
		load.html('<img src="images/ajax-loader.gif" />');
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

function setConteudo(pagina) {
	$('#conteudo').empty();
	$.ajax({
		type: "GET",
		url: pagina,
	
		success: function(data){
			$('#conteudo').html(data); 	
		}
	});
}


