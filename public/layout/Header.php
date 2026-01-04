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
    
  </style>
</head>
<body>

  <div id="Corpo">
    <div id="Cabecario">
      <a href="https://hemetec.com.br">
      	<img src="imagens/logo.jpg" width="300" height="300" alt="Logo" title="logo" id="Logo" />
      </a>

        <?php
            require_once "../app/controller/postNext.php";
            $nextPost = new NextPost();  
            $nextPost->atualizar();
      		//echo $_SESSION['nome'];
        ?>
      	
        <div class="botoes">
          <?php 
          //var_dump($_SESSION['erro']);
                  if (isset($_SESSION['email'])){?>
                    <!-- Menu só aparece se estiver logado -->
                    <div id="popupMenu">
                      <a href="router.php?action=index">Home</a>
                      <a href="router.php?action=Admin#Topo">Admin</a>
                      <a href="../app/controller/postNext.php?action=chamar">Página de Notícias</a>
                      <!--<a href="router.php?action=noticias" aria-disabled="true"> Noticia teste </a>-->
                      <a href="router.php?action=logout">Sair</a>
                    </div>
                    <button id="menuBtn">-<br>-<br></button>
          <?php } else{ ?>
              <!-- Botões de login/registro -->
              <button id="btnEntrar" class="Botoes">Login</button>
          <?php }; ?>
        </div>
      <div id="Banner"></div>
    </div>
  </div>
     <script src="../app/view/script.js"></script>

</body>
