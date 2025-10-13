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
    <title>Home</title>
</head>
<body>
        <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['usuarioLogado'])) {
                var_dump ("Usuário logado: " . $_SESSION['usuarioLogado']);
            } else {
                var_dump ("Nenhum usuário logado");
            }
        ?>
        <?php include 'Layout/Header.php'; ?><br><br>
  </div>
            
        </div>

                
        <h1>Seja bem-vindo ao Hemetec</h1>
        <h2>
            Lorem ipsum dolor sit amet. Qui vero dolorum est fugit quae eum incidunt voluptate est
            galisum dolorem? Qui nihil consequatur qui perspiciatis porro et velit illum. Qui culpa
            perferendis et architecto amet non nisi praesentium ut eveniet molestiae cum soluta sequi
            qui omnis ipsam est enim dolorem? Ut voluptatem voluptatem et explicabo facilis qui
            consequatur explicabo.
        </h2>
        
        <br><hr><hr><br>
        <h3>Navegação Rápida</h3> 
        <div class="cards"> 
            <div></div><div></div><div></div>
        </div>
        
        <br><hr><hr><br>
        <h3>Últimos Posts</h3> 
        <div class="cards posts"> 
            <div></div><div></div><div></div>
            <div></div><div></div><div></div>
        </div>

        <br>
        <a href="https://www.instagram.com/drufinhooficial/">@hemetec</a>

        <br>
        <a href="https://github.com/MatheusLima1234/LevelTracks">GitHub do Hemetec</a>
        <br><br>

        <footer>
            2025 © HEMETEC - Todos os direitos reservados
        </footer>
    </div>
    
</body>
</html>
