<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/Login.css">
	<link rel="stylesheet" href="css/Fontes.css">
	<link rel="stylesheet" href="css/Cores.css">
	<title>Login</title>
</head>
<body>
	<div id="CorpoLogin">
		<div id="ContainerLogo">
			<img src="imagens/LevelLogo.png" alt="Logo" title="LEVELTRACKS" id="Logo" />
			<div id="LoginHemetec"><h1>Hemetec</h1></div>
		</div>
		<div id="LoginCard">
			<div id="Opcao">
				
			</div>
			<div id="Bem"><h1>Bem vindo de volta</h1></div>
			
		<form method="post" action="router.php?action=logar" id="Login">
			<input type="email" name="email" required placeholder=" User@email.com"><br>

			<input type="password" id="senha" name="senha" maxlength="24" minlength="8" required placeholder=" Senha"><br>
			<span id="senha-error" class="error-message"></span>
			
				<!-- definindo um valor para diferenciar tipos de login -->
			<button type="submit" id="Correio"> Iniciar sessão com correio eletronico</button>
		</form>
		<a href="router.php?action=cadastro"><button type="submit" id="Correio" value="loginEmail"> Cadastrar</button></a>

		<form method="post" action="logar">
			<button type="submit" name="google" id="Google" value="loginGoogle"> Google</button>
		</form>
		<script src="senha.js"></script>

		<div id="Termo"> 
			Ao prosseguir, o utilizador concorda com os nossos<br>
			<a href="Termos.html" class="Termos">	Termos</a> e
			<a href="Termos.html" class="Termos">	Politicas de Privacidade</a> 
		</div>
		</div>
	</div>
	
</body>
</html>