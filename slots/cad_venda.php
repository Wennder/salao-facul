<?php		
	require_once('../include_dao.php');
	
	$id = $_GET['id'];
	$editando = $id != null;
	
	if ($editando) {
		$venda = DAOFactory::getVendaDAO()->load($id);
	}
	
	$clientes = DAOFactory::getClienteDAO()->queryAllOrderBy("nome");
	$servicos = DAOFactory::getServicoDAO()->queryAllOrderBy("descricao");
	$produtos = DAOFactory::getProdutoDAO()->queryAllOrderBy("descricao");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="titulo" style="margin: auto; width: 350px;">
		<span style="float: left;">Informe os dados da venda</span>
		<div style="float: right;">
		<button class="btn btn-primary" onclick="javascript:setConteudo('slots/pesquisa_vendas.php');">Pesquisar</button>
		</div>
	</div>
	
<form id="form_cad_venda" style="margin: auto; width: 100%;" 
	action="cadastrar_venda.php"
	onsubmit="return false">
				<input type="hidden" name="id" <?php if($editando){echo "value=\"".$venda->id."\"";}?> />
				<label>Cliente</label>
				<select id="cliente" name="cliente">
				<?php 
					for ($i=0; $i<sizeof($clientes); $i++) {
						if (!$clientes[$i]->admin)
						//echo "<input type=\"hidden\" value=\"".$clientes[$i]->id."\" />";
						echo "<option>" . $clientes[$i]->nome . "</option>";
					}
				?>	
				</select>
				<table style="width: 100%;">
					<th><label>Adicionar serviço</label>
					</th>
					<th><label>Adicionar produto</label>
					</th>
					<tr>
						<td style="width: 50%;">
						<div class="input-append">
						<select style="width: 88%;" id="servico">
								<?php 
								for ($i=0; $i<sizeof($servicos); $i++) {
									echo "<option>" . $servicos[$i]->descricao . "</option>";
									echo "<option hidden=\"hidden\">" . $servicos[$i]->valor . "</option>";
								}
								?>
						</select>
						<button class="btn" id="btAddServico">+</button>
						</div>
						</td>
						<td style="width: 50%;">
						<div class="input-append">
						<select style="width: 90%;" id="produto">
								<?php 
								for ($i=0; $i<sizeof($produtos); $i++) {
									echo "<option>" . $produtos[$i]->descricao . "</option>";
									echo "<option hidden=\"hidden\">" . $produtos[$i]->valorUnitario . "</option>";
								}
								?>
						</select>
						<button class="btn" id="btAddProduto">+</button>
						</div>
						</td>
					</tr>
				</table>
				<h4>Produtos</h4>
				<table class="table table-condensed" id="produtos">
					<th>Descrição</th>
					<th>Qtde</th>
					<th>Valor unitário</th>
					<th></th>
				</table>
				<table style="width: 100%;">
					<th><label>Total</label>
					</th>
					<th><label>Total pago</label>
					</th>
					<tr>
					<td>
					<input name="total" value="0" id="total" type="text" style="width: 50px"/>
					</td>
					<td>
					<input name="totalpago" value="0" id="totalpago" type="text" style="width: 50px"/>
					</td>
					</tr>
				</table>

			<div style="width: 100%">
				<div class="loading" style="float: left;"></div>
				<button style="float: right;" class="btn" onclick="return submitFormVenda();">Salvar</button>
			</div>
</form>
<script type="text/javascript">

function submitFormVenda() {
	var form = $(event.target).closest("form");
	if (!form.valid())
		return false;
	
	var table = $("#produtos");
	var spans = table.find("span");
	var json = "[";
	for (var i=0; i<spans.length; i++) {
		var qtde = $(spans[i]).parent().next().find("input").val();
		json += "{\"descricao\":\"" + $(spans[i]).text() + "\", \"qtde\":\"" + qtde + "\"},";
	}
	
	json = json.substring(0, json.length-1) + "]";
	
	var data = form.find("select, input").serialize(); // Dados do formulário   
	var load = form.find('.loading');
	if (load)
		load.html('<img src="img/ajax-loader.gif" />');
        // Envia o formulário via Ajax
        $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: data + "&itens=" + json,
                success: function(json)
                {
                   load.empty();
                   var status = eval('(' + json + ')');
				   if (status.tipo == 'ok') {
					   noty({layout: 'center', type: 'success', text: status.info});
				   }
				   else {
					   noty({layout: 'center', type: 'error', text: status.info});
				   }
				   
                },
                error:function(XMLHttpRequest, textStatus, errorThrown)
                {
                	load.empty();
                	noty({layout: 'center', type: 'error', text: errorThrown});
                }
        });
        return false; // Previne o form de ser enviado pela forma normal
	}
 
	function atualizarTotal() {
		var total = $("#total");
		var t = 0;
		var table = $("#produtos");
		var trs = table.find("tr");
		for (var i=1; i<trs.length; i++) {
			var tds = $(trs[i]).children();
			t += parseInt($(tds[2]).text().split("R$ ")[1]) * parseInt($(tds[1]).find("input").val());
		}
		
		total.val(t ? t : "0");
	}

	function bindQtde() {
		var table = $("#produtos");
		var trs = table.find("tr");
		for (var i=1; i<trs.length; i++) {
			var tds = $(trs[i]).children();
			$(tds[1]).change(function () {
				atualizarTotal();
			})
		}
	}
								
		function addProduto(desc, qtde, valor) {
			var table = $("#produtos");
			var spans = table.find("span");
			var jaTem = false;
			for (var i=0; i<spans.length; i++) {
				if (desc == $(spans[i]).text()) {
					jaTem = true;
					break;
				}
			}
			
			if (!jaTem) {
				table.append("<tr><td><span>" + desc + "</span></td><td><input type=\"text\" value=\""+qtde+ "\" style=\"width: 20px\" />" +
						"<td>R$ " + valor + "</td>" +
						"</td><td><a class=\"btn\" style=\"float: right;\">x</a></td></tr>");
				atualizarTotal();
				bindQtde();
				table.find("a").click(function() {
					table.remove($(this).parent().parent().remove());
				});
			}
		}
								
		$("#btAddServico").click(function (){
			var serv = $("#servico").val();
			var valor = $("#servico :selected").next().val();
			addProduto(serv, 1, valor);
		});

		$("#btAddProduto").click(function (){
			var prod = $("#produto").val();
			var valor = $("#produto :selected").next().val();
			addProduto(prod, 1, valor);	
		});

		<?php 
				if ($editando) {
					$c = DAOFactory::getClienteDAO()->load($venda->clienteId);
					echo "$(\"#cliente\").val(\"$c->nome\");";
					
					$servs = DAOFactory::getServicoVendaDAO()->queryByVenda($venda->id);
					for ($i=0; $i<sizeof($servs); $i++) {
						$s = DAOFactory::getServicoDAO()->load($servs[$i]->servicoId);
						echo "addProduto('" . $s->descricao . "'," .  $servs[$i]->qtde . "," . $s->valor . ");";
					}
					
					$prods = DAOFactory::getProdutoVendaDAO()->queryByVenda($venda->id);
					for ($i=0; $i<sizeof($prods); $i++) {
						$p = DAOFactory::getProdutoDAO()->load($prods[$i]->produtoId);
						echo "addProduto('" . $p->descricao . "'," .  $prods[$i]->qtde . "," . $p->valorUnitario . ");";
					}
				}
			?>

</script>
</body>
</html>
