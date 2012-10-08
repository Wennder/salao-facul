function logar() {
	jQuery.ajax({
		type: "POST",
		url: "autentica.php",
		data: { username: jQuery('#username').val(), senha: jQuery('#senha').val() },
		success: function(data){
//			$(".alert").css("display", "block");
			var json = eval('(' + data + ')');
			if (json.tipo == "ok") {
				location.href = 'index.php';
			} else {
				jQuery(".error").html(json.info);
			}
		},
		error: function(xhr, textStatus, errorThrown){
			jQuery(".error").html("Houve um erro no servidor, contate o administrador do sistema");
		}
	});
	return false;
}