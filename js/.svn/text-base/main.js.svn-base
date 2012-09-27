
jQuery(document).ready(function(){
	mostrarCadastroLicenca();
});
            

function onEnter(func, e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;

	if (keycode == 13) {
	  func.call();
	  return false;
	}
	else
	  return true;
}

function setConteudo(pagina) {
	jQuery('#conteudo').empty();
	jQuery.ajax({
		type: "GET",
		url: pagina,
	
		success: function(data){
			jQuery('#conteudo').html(data); 	
		}
	});
}
