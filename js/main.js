
$(document).ready(function(){
	$("#loading").ajaxStart(function(){
		$(this).show();
	});
	$("#loading").ajaxStop(function(){
		$(this).hide();
	}); 
	
});

function submitForm() {
	var jid='#'+$(event.target).closest("form").attr('id');
	if (!$(jid).valid())
		return false;
	
	var data = $(jid).find('input').serialize(); // Dados do formulário    

        // Envia o formulário via Ajax
        $.ajax({
                type: 'POST',
                url: $(jid).attr('action'),
                data: data,
                success: function(json)
                {
                   var status = eval('(' + json + ')');
				   if (status.tipo == 'ok') {
					 
				   }
				   else {
						
				   }
				   
                },
                error:function(XMLHttpRequest, textStatus, errorThrown)
                {
					
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
