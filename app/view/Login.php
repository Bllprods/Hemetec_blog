<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php
              if (!empty($act) && $act === "vrc") {
            	echo "
                <script>
                  window.onload = function() {
                    const emaildiv = document.getElementById('emaildiv');
                    const codediv = document.getElementById('codediv');
                    const corpoRedSenha = document.getElementById('corpoRedSenha');
                    if (codediv && emaildiv) {
                      emaildiv.style.display = 'none';
                      corpoRedSenha.style.display = 'block';
                      codediv.style.display = 'block';
                    }
                  };
                </script>";
            }
  ?>
    <div id="CorpoLogin">
            <div id="LoginCard">
                <div class="closeBtn">
                    <span class="closeBtn">&times;</span>
                </div>
                   
              <form method="post" action="router.php?action=logar" id="Login">
                <input type="email" name="email" class="Input" required placeholder=" User@email.com"><br>

                <input type="password" id="senha" class="Input" name="senha" maxlength="24" minlength="8" required placeholder=" Senha"><br>
                <span id="senha-error" class="error-message"></span>
                <a id="redSenha" href="#">Esqueci minha senha</a>
                <button type="submit"class="Correio">Logar com e-mail</button><br>
              </form>
              <form method="post" action="logar">
                <button type="submit" name="google" class="Correio" value="loginGoogle">Continuar com o Google</button>
              </form>
      </div>
    </div>
    <script src="../app/view/senha.js"></script>   
</body>

 