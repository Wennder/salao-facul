function logar() {
	jQuery.ajax({
		type: "POST",
		url: "autentica.php",
		data: { username: jQuery('#username').val(), senha: jQuery('#senha').val() },
		success: function(data){
			var json = eval('(' + data + ')');
			if (json.tipo == "ok") {
				location.href = 'index.php';
			} else {
				jQuery('#loginErro').html(json.info);
			}
		},
		error: function(xhr, textStatus, errorThrown){
			jQuery('#loginErro').html("Houve um erro no servidor, contate o administrador do sistema");
		}
	});
}