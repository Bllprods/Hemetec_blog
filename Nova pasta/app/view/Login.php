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
            <div id="LoginCard">
                <span class="closeBtn">&times;</span>
                   
        <form method="post" action="router.php?action=logar" id="Login">
            <input type="text" name="email" class="Input" required placeholder=" User@email.com"><br>
           
            <input type="password" id="senha" class="Input" name="senha" maxlength="24" minlength="8" required placeholder=" Senha"><br>
            <span id="senha-error" class="error-message"></span>
           
            <!-- definindo um valor para diferenciar tipos de login -->
            <button type="submit"class="Correio"> Logar com e-mail</button><br>
            <a href="router.php?action=cadastro"><button type="submit"class="Correio" value="loginEmail"> Cadastrar</button></a>
        </form>
        <form method="post" action="logar">
            <button type="submit" name="google" id="Google" value="loginGoogle"> Continuar com o Google</button>
        </form>
 
    </div>
   
    <script src="../app/view/Senha.js"></script>
</body>
</html>
 