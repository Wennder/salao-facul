<?php		
	require_once('../include_dao.php');
	
	$id = $_GET['id'];
	$editando = $id != null;
	
	if ($editando) {
		$func = DAOFactory::getFuncionarioDAO()->load($id);
	}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="titulo" style="margin: auto; width: 400px;">
		<span style="float: left;">Informe os dados do funcionário</span>
		<div style="float: right;">
		<button class="btn btn-primary" onclick="javascript:setConteudo('slots/pesquisa_funcionarios.php');">Pesquisar</button>
		</div>
	</div>
<form id="form_cad_funcionario" style="margin: auto; width: 400px;" 
	action="cadastrar_funcionario.php"
	onsubmit="return false" 
	onkeypress="if(checkEnter(event)){return submitForm('slots/pesquisa_funcionarios.php')};">
				<input type="hidden" name="id" <?php if($editando){echo "value=\"".$func->id."\"";}?> />
				<label>Nome</label>
				<input type="text" name="nome" <?php if($editando){echo "value=\"".$func->nome."\"";}?> />
				<label>Endereco</label>
				<input type="text" name="endereco" <?php if($editando){echo "value=\"".$func->endereco."\"";}?> />
				<label>Rg</label>
				<input type="text" name="rg" <?php if($editando){echo "value=\"".$func->rg."\"";}?> />
				<label>Cpf</label>
				<input type="text" name="cpf" <?php if($editando){echo "value=\"".$func->cpf."\"";}?> />
				<label>Telefone</label>
				<input type="text" name="telefone" <?php if($editando){echo "value=\"".$func->telefone."\"";}?> />
				<label>Cargo</label>
				<input type="text" name="cargo" <?php if($editando){echo "value=\"".$func->cargo."\"";}?> />
				<label>Data de admissão</label>
				<input type="text" name="dataAdmissao" <?php if($editando){echo "value=\"".$func->dataAdmissao."\"";}?> />
				<label>Obs</label>
				<input type="text" name="obs" <?php if($editando){echo "value=\"".$func->obs."\"";}?> />
			<div style="width: 100%">
				<div class="loading" style="float: left;"></div>
				<button style="float: right;" class="btn" onclick="return submitForm();">Salvar</button>
			</div>
</form>
<script type="text/javascript">
       $('#form_cad_funcionario').validate({
            rules:{
                nome:{
                    required: true
                },
                cpf:{
                    required: true
                },
                rg:{
                    required: true
                }
            },
            messages:{
                nome:{
                    required: "Você deve informar o nome."
                },
                cpf:{
                    required: "Você deve informar o Cpf."
                },
                rg:{
                    required: "Você deve informar o Rg."
                }
            },
            wrapper: "div class=\"error\""
        });
</script>
</body>
</html>
