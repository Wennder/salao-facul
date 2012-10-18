<?php		
	require_once('../include_dao.php');
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="titulo" style="margin: auto; width: 350px;">
		<span style="float: left;">Registrar despesas do salão</span>
		<div style="float: right;">
		<button class="btn btn-primary" onclick="javascript:setConteudo('slots/pesquisa_clientes.php');">Pesquisar</button>
		</div>
	</div>
<form id="form_cad_despesa" style="margin: auto; width: 350px;" 
	action="cadastrar_despesa.php"
	onsubmit="return false" 
	onkeypress="if(checkEnter(event)){return submitForm('slots/cad_despesa.php')};">
				<input type="hidden" name="id" />
				<label>Ano</label>
				<input type="text" name="ano" id="ano"/>
				<label>Mês</label>
				<select name="mes">
				  <option>Janeiro</option>
				  <option>Feveiro</option>
				  <option>Março</option>
				  <option>Abril</option>
				  <option>Maio</option>
				  <option>Junho</option>
				  <option>Julho</option>
				  <option>Agosto</option>
				  <option>Setembro</option>
				  <option>Outubro</option>
				  <option>Novembro</option>
				  <option>Dezembro</option>
				</select>
				<label>Tipo</label>
				<select name="tipo">
				  <option>Luz</option>
				  <option>Água</option>
				  <option>Telefone</option>
				  <option>Panificadora</option>
				  <option>Confecção</option>
				  <option>Mercado</option>
				  <option>Farmácia</option>
				  <option>Cursos</option>
				  <option>Outros</option>
				</select>
				<label>Valor</label>
				<div class="input-prepend input-append">
  					<span class="add-on">R$</span><input name="valor" class="span2" type="text" style="width: 88%;" />
				</div>
			<div style="width: 100%">
				<div class="loading" style="float: left;"></div>
				<button style="float: right;" class="btn" onclick="return submitForm();">Registrar despesa</button>
			</div>
</form>
<script type="text/javascript">
	   $("#ano").val((new Date).getFullYear());

       $('#form_cad_despesa').validate({
            rules:{
                ano:{
                    required: true,
                    minlength: 4,
                    digits: true
                },
                valor:{
                    required: true,
                    number: true
                }
            },
            messages:{
                ano:{
                    required: "Você deve informar o ano",
                    minlength: "Informe um ano válido (ex: 2012)",
                    digits: "Informe um ano válido (ex: 2012)"
                },
                valor:{
                    required: "Você informar o valor da despesa",
                    number: "Informe um valor válido"
                }
            },
            wrapper: "div class=\"error\""
        });
</script>
</body>
</html>
