<?php		
	include_once('../verificar_logado.php');
	require_once('../include_dao.php');
	
	$id = $_GET['id'];
	$editando = $id != null;
	
	if ($editando) {
		$cli = DAOFactory::getProdutoDAO()->load($id);
	}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="titulo" style="margin: auto; width: 350px;">
		<span style="float: left;">Informe os dados do cliente</span>
		<div style="float: right;">
		<button class="btn btn-primary" onclick="javascript:setConteudo('slots/pesquisa_clientes.php');">Pesquisar</button>
		</div>
	</div>
<form id="form_cad_cliente" style="margin: auto; width: 350px;" 
	action="cadastrar_cliente.php"
	onsubmit="return false" 
	onkeypress="if(checkEnter(event)){return submitForm(true)};">
				<input type="hidden" name="id" <?php if($editando){echo "value=\"".$cli->id."\"";}?> />
				<label>Nome</label>
				<input type="text" name="nome" <?php if($editando){echo "value=\"".$cli->nome."\"";}?> />
				<label>Endereco</label>
				<input type="text" name="endereco" <?php if($editando){echo "value=\"".$cli->endereco."\"";}?> />
				<label>Rg</label>
				<input type="text" name="rg" <?php if($editando){echo "value=\"".$cli->rg."\"";}?> />
				<label>Cpf</label>
				<input type="text" name="cpf" <?php if($editando){echo "value=\"".$cli->cpf."\"";}?> />
				<label>Data de nascimento</label>
				<input type="text" name="nasc" <?php if($editando){echo "value=\"".$cli->nasc."\"";}?> />
				<label>Telefone</label>
				<input type="text" name="telefone" <?php if($editando){echo "value=\"".$cli->telefone."\"";}?> />
				<label>Celular</label>
				<input type="text" name="celular" <?php if($editando){echo "value=\"".$cli->celular."\"";}?> />
				<label>Endereco / Trabalho</label>
				<input type="text" name="enderecoTrabalho" <?php if($editando){echo "value=\"".$cli->enderecoTrabalho."\"";}?> />
				<label>Telefone / Trabalho</label>
				<input type="text" name="telefoneTrabalho" <?php if($editando){echo "value=\"".$cli->telefoneTrabalho."\"";}?> />
				<label>Cabelo</label>
				<input type="text" name="cabelo" <?php if($editando){echo "value=\"".$cli->cabelo."\"";}?> />
				<label>Username</label>
				<input type="text" name="username" <?php if($editando){echo "value=\"".$cli->username."\"";}?> />
				<label>Senha</label>
				<input type="password" name="senha" <?php if($editando){echo "value=\"".$cli->senha."\"";}?> />
			<div style="width: 100%">
				<div class="loading" style="float: left;"></div>
				<button style="float: right;" class="btn" onclick="return submitForm();">Salvar</button>
			</div>
</form>
<script type="text/javascript">
       $('#form_cad_cliente').validate({
            rules:{
                nome:{
                    required: true
                },
                cpf:{
                    required: true
                },
                rg:{
                    required: true
                },
                nasc:{
                	dateBR: true
                },
				username:{
                    required: true
                },
				senha:{
                    required: true,
                    minlength: 5
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
                },
                nasc: {
                	dateBR: "Informe uma data de válida"
                },
				username:{
                    required: "Você deve informar o nome de usuário."
                },
				senha:{
                    required: "Você deve informar a senha.",
                    minlength: "A senha deve conter no mínimo 5 caracteres."
                }
            },
            wrapper: "div class=\"error\""
        });
</script>
</body>
</html>
