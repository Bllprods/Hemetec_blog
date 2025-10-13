<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Home.css">
    <link rel="stylesheet" href="css/Cabecario.css">
    <link rel="stylesheet" href="css/Fontes.css">
    <link rel="stylesheet" href="css/Cores.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Header</title>
    <style>
    /#menuBtn {
      background: #c4550c;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;  
    }
    /* Menu */
    #popupMenu {
      display: none;
      color: white;
      background-color: rgba(238,143,90, 0.93);
      border: 1px solid #ccc;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      min-width: 150px;
      border-radius: 10px;
      position: absolute;  
      
    }
    #popupMenu a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: white;
    }
    #popupMenu a:hover {
      background-color: #f0f0f0;
      color: black;
    }
  </style>
</head>
<body>
  <div id="Corpo">
    <div id="Cabecario">

     
      
      <img src="imagens/Logo.jpg" width="300" height="300" alt="Logo" title="logo" id="Logo" />

        
        <?php

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            
            // if (!empty($_SESSION['nome']) && !empty($_SESSION['email'])) {
            //     echo "Usuário logado: " . $_SESSION['nome'] . "<br>Email: " . $_SESSION['email'] . "<br> cod adm: " . $_SESSION["idAdm"] . "<br> nivel acesso: " . $_SESSION["nivel_acesso"];
            // } else {
            //     echo "Nenhum usuário logado";
            // }
            require_once "../app/controller/postNext.php";
            $nextPost = new NextPost();  
            $nextPost->atualizar();
        ?>

        <div class="botoes">
          <?php if (session_status() === PHP_SESSION_ACTIVE){ 
                  if (isset($_SESSION['email'])){?>
                    <!-- Menu só aparece se estiver logado -->
                    <div id="popupMenu">
                      <a href="router.php?action=index">Home</a>
                      <a href="router.php?action=Admin">Admin</a>
                      <a href="../app/controller/postNext.php?action=chamar">Pagina de Noticias</a>
                      <a href="router.php?action=noticias" aria-disabled="true"> Noticia teste </a>
                      <a href="router.php?action=logout">Sair</a>
                    </div>
                    <button id="menuBtn">-<br>-<br></button>
          <?php } else{ ?>
              <!-- Botões de login/registro -->
              <a href="router.php?action=login" id="btnEntrar">Entrar</a>
          <?php }}; ?>
        </div>
      <div id="Banner"></div>
    </div>

    <script>
    const menuBtn = document.getElementById('menuBtn');
    const popupMenu = document.getElementById('popupMenu');

    if(menuBtn){
        menuBtn.addEventListener('click', () => {
          popupMenu.style.display = popupMenu.style.display === 'block' ? 'none' : 'block';
        });

        window.addEventListener('click', (e) => {
          if (!menuBtn.contains(e.target) && !popupMenu.contains(e.target)) {
            popupMenu.style.display = 'none';
          }
        });
    }
    </script>
</body>
</html>
