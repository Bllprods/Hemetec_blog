<?php 
// O router vai incluir esta view
// A variável $erro estará disponível aqui
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="imagens/logoIco.ico">
    <title>Cadastro</title>
</head>
<body>
    <div id="CorpoLoginCad">
        <div id="LoginCard">
            <div id="Bem">
                <h1>Crie sua conta</h1>
            </div>

            <form method="post" action="router.php?action=cadastraU" id="Cadastro">
                <input class="Input" type="text" id="txtName" name="nome_de_usuario" required placeholder=" Nome de Usuário"><br>
                <div>
                    <input class="Input" type="email" id="txtEmail" name="email" required placeholder=" user@email.com"><br>
                    <p id="msgEmail"></p>
                </div>
                <div>
                    <input class="Input" type="password" id="txtPsw1" name="senha" maxlength="24" minlength="8" required placeholder=" Senha"><br>
                    <input class="Input" type="password" id="txtPsw2" name="confirma_senha" maxlength="24" minlength="8" required placeholder=" Confirmar Senha"><br>
                    <p id="msgConfS"></p>
                </div>
                <button type="submit" class="Correio" id="cadBtn">Cadastrar</button>
                <div id="Termo"> 
                    Ao prosseguir, o Usuário concorda com os nossos 
                    <a href="Termos.html" class="Termos"> Termos</a> e
                    <a href="Termos.html" class="Termos"> Políticas de Privacidade</a> 
                </div>
            </form>
        </div>
    </div>
  	<script src="../app/view/scriptMascara.js"></script>
    <script src="../app/view/Senha.js"></script>
</body>
</html>