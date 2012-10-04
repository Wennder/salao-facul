<?php		
	include_once('../verificar_logado.php');
	require_once('../include_dao.php');
	
	$id = $_GET['id'];
	$editando = $id != null;
	
	if ($editando) {
		$prod = DAOFactory::getProdutoDAO()->load($id);
	}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div class="titulo" style="margin: auto; width: 350px;">
		<span style="float: left;">Informe os dados do produto</span>
		<div style="float: right;">
		<button class="btn btn-primary" onclick="javascript:setConteudo('slots/pesquisa_produtos.php');">Pesquisar</button>
		</div>
	</div>
<form id="form_cad_produto" style="margin: auto; width: 350px;" 
	action="cadastrar_produto.php"
	onsubmit="return false" 
	onkeypress="if(checkEnter(event)){return submitForm()};">

			<div class="cadastro">
					<input type="hidden" name="id" <?php if($editando){echo "value=\"".$prod->id."\"";}?> />
					<label>Descrição</label>
					<input type="text" name="descricao" <?php if($editando){echo "value=\"".$prod->descricao."\"";}?> />
					<label>Qtde estoque</label>
					<input type="text" name="qtdeEstoque" <?php if($editando){echo "value=\"".$prod->qtdeEstoque."\"";}?> />
					<label>Qtde última compra</label>
					<input type="text" name="qtdeUltimaCompra" <?php if($editando){echo "value=\"".$prod->qtdeUltimaCompra."\"";}?> />
					<label>Valor unitário</label>
					<input type="text" name="valorUnitario" <?php if($editando){echo "value=\"".$prod->valorUnitario."\"";}?> />
					<label>Marca</label>
					<input type="text" name="marca" <?php if($editando){echo "value=\"".$prod->marca."\"";}?> />
					<label>Data</label>
					<input type="text" name="data" <?php if($editando){echo "value=\"".$prod->data."\"";}?> />
			</div>
			<div style="width: 100%">
				<div class="loading" style="float: left;"></div>
				<button style="float: right;" class="btn" onclick="return submitForm();">Salvar</button>
			</div>
</form>
<script type="text/javascript">
       $('#form_cad_produto').validate({
            rules:{
                descricao:{
                    required: true
                },
                valor_unit:{
                    required: true,
                    number: true
                },
                data: {
                	dateBR: true
                }
            },
            messages:{
            	descricao:{
                    required: "Você deve informar a descrição."
                },
                valor_unit:{
                    required: "Você deve informar o valor unitário.",
                    number: "Informe um valor válido"
                },
                data: {
                	dateBR: "Informe uma data válida"
                }
            },
            wrapper: "div class=\"error\""
        });
</script>
</body>
</html>
