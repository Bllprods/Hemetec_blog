<?php 
// O router vai incluir esta view
// A variável $erro estará disponível aqui
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="css/Fontes.css">
   
    <title>Cadastro</title>
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
            <div id="Bem"><h1>Crie sua conta</h1></div>

            <form method="post" action="router.php?action=cadastraU" id="Cadastro">
                <input type="text" name="nome_de_usuario" required placeholder=" Nome de Usuário"><br>
                <input type="email" name="email" required placeholder=" user@email.com"><br>
                <input type="password" name="senha" maxlength="24" minlength="8" required placeholder=" Senha"><br>
                <input type="password" name="confirma_senha" maxlength="24" minlength="8" required placeholder=" Confirmar Senha"><br>
                
                <button type="submit" id="Correio">Cadastrar</button>
            </form>
            
            <div id="Termo"> 
                Ao prosseguir, o utilizador concorda com os nossos<br>
                <a href="Termos.html" class="Termos"> Termos</a> e
                <a href="Termos.html" class="Termos"> Politicas de Privacidade</a> 
            </div>
            </div>
        </div>
</body>
</html>