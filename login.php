<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>

<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>	
		<form id="form_cad_despesa" style="margin: auto; width: 240px;" 
			onsubmit="return false" 
			onkeypress="if(checkEnter(event)){return logar()};">
			<legend>Autenticação de usuário</legend>
				<label>Nome de usuário</label>
				<input type="text" id="username"/>
				<label>Senha</label>
				<input type="password" id="senha"/>
				<div class="error"">
				<span id="loginErro"/></span>
				</div>
				<button class="btn" style="float: right;">Logar</button>
			</table>	
		</form>
		
<script src="js/jquery-1.7.2.js" type="text/javascript"></script>  
<script src="js/login.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>