<?php		
	require_once('../include_dao.php');
	
	$all = DAOFactory::getConfiguracaoDAO()->queryAll();
	$editando = sizeof($all) > 0;
	if ($editando) 
		$conf = $all[0];
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="titulo" style="margin: auto; width: 350px;">
		<span style="float: left;">Configurações do sistema</span>
	</div>
	
<form id="form_configuracoes" style="margin: auto; width: 350px;" 
	action="cadastrar_configuracao.php"
	onsubmit="return false" 
	onkeypress="if(checkEnter(event)){return submitForm('slots/configuracoes_sistema.php')};">
				<input type="hidden" name="id" <?php if($editando){echo "value=\"".$conf->id."\"";}?> />
				<label>Nome da empresa</label>
				<input type="text" name="nomeEmpresa" <?php if($editando){echo "value=\"".$conf->nomeEmpresa."\"";}?> />
				<label>Email</label>
				<input type="text" name="email" <?php if($editando){echo "value=\"".$conf->email."\"";}?>/>
				<label>Telefone</label>
				<input type="text" name="telefone" <?php if($editando){echo "value=\"".$conf->telefone."\"";}?> />
				<label>Percentual padrão</label>
				<input type="text" name="percentualPadrao" <?php if($editando){echo "value=\"".$conf->percentualPadrao."\"";}?> />
			<div style="width: 100%">
				<div class="loading" style="float: left;"></div>
				<button style="float: right;" class="btn" onclick="return submitForm();">Salvar</button>
			</div>
</form>
<script type="text/javascript">
	$('#form_configuracoes').validate({});
</script>
</body>
</html>
