<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>

<head>
<script src="js/jquery-1.4.4.min.js" type="text/javascript"></script>  
<script src="js/login_min.js" type="text/javascript"></script>
<script src="js/main_min.js" type="text/javascript"></script>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>	
		<div style="margin: auto; width: 240px">
			<h3 style="text-align: center">Autenticação de usuário</h3>
			<table style="width: 100%">
				<tr>
				<td style="float: right">Usuário:</td>
				<td><input type="text" name="username" id="username" style="width: 160px" onkeypress="return onEnter(logar, event);"/></td>
				</tr>
				<tr>
				<td style="float: right">Senha:</td>
				<td><input type="password" name="senha" id="senha" style="width: 160px" onkeypress="return onEnter(logar, event);"/></td>
				</tr>
				<tr>
				<td></td>
				<td><span id="loginErro" style="color: red"/></span></td>
				</tr>
				<tr>
				<td></td>
				<td><button onclick="logar()">Logar</button></td>
				</tr>
			</table>	
		</div>
</body>
</html>