<?php		
	include_once('../verificar_logado.php');
	require_once('../include_dao.php');
	
	$id = $_GET['id'];
	$editando = $id != null;
	
	if ($editando) {
		$serv = DAOFactory::getServicoDAO()->load($id);
	}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="titulo" style="margin: auto; width: 350px;">
		<span style="float: left;">Informe os dados do servico</span>
		<div style="float: right;">
		<button class="btn btn-primary" onclick="javascript:setConteudo('slots/pesquisa_servicos.php');">Pesquisar</button>
		</div>
	</div>
	
<form id="form_cad_servico" style="margin: auto; width: 350px;" 
	action="cadastrar_servico.php"
	onsubmit="return false" 
	onkeypress="if(checkEnter(event)){return submitForm()};">
				<input type="hidden" name="id" <?php if($editando){echo "value=\"".$serv->id."\"";}?> />
				<label>Descrição</label>
				<input type="text" name="descricao" <?php if($editando){echo "value=\"".$serv->descricao."\"";}?> />
				<label>Valor</label>
				<input type="text" name="valor" <?php if($editando){echo "value=\"".$serv->valor."\"";}?>/>
				<label>Horas</label>
				<input type="text" name="horas" <?php if($editando){echo "value=\"".$serv->horas."\"";}?>/>
			<div style="width: 100%">
				<div class="loading" style="float: left;"></div>
				<button style="float: right;" class="btn" onclick="return submitForm();">Salvar</button>
			</div>
</form>
<script type="text/javascript">
       $('#form_cad_servico').validate({
            rules:{
                descricao:{
                    required: true
                },
                valor:{
                    required: true,
                    number: true
                },
                horas: {
                	required: true,
                	number: true
                }
            },
            messages:{
            	descricao:{
                    required: "Você deve informar a descrição do serviço."
                },
                valor:{
                    required: "Você deve informar quanto custará o serviço.",
                    number: "Informe um valor válido"
                },
                horas: {
                	required: "Você deve informar quanto tempo (em horas) levará para realizar o serviço",
                	number: "Informe um horário válido"
                }
            },
            wrapper: "div class=\"error\""
        });
</script>
</body>
</html>
