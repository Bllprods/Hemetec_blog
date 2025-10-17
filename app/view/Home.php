<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Home.css">
    <link rel="stylesheet" href="css/Fontes.css">
    <link rel="stylesheet" href="css/style.css">
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
                
            }
        ?>

        <?php
        $headerPath = __DIR__ . "/../../public/layout/Header.php"; // ajusta conforme estrutura do seu projeto
        if (file_exists($headerPath)) {
            include_once $headerPath;
        } else {
            error_log("Header não encontrado: $headerPath");
            // opcional: exibir marcador visual
            // echo "<!-- header não encontrado: $headerPath -->";
        }
        ?><br><br>
            <?php include  __DIR__ . "/../view/Login.php" ;?>

        
        <!-- <button id="openLoginBtn">Login</button> 
        <button id="router.php?action=cadastro">Admin</button> -->
       
  </div>
           
        <div id ="Corpo">
            <!-- <a href="../public/router.php?action=Admin">[Admin]</a>
            <a href="../app/controller/postNext.php">[Pagina de Noticias]</a>
            <a href="../public/router.php?action=cadastro">[cadastro]</a> -->
        <!---<a href="../public/router.php?action=noticias">Noticia teste</a>--->
        <h1>Seja bem-vindo ao Hemetec</h1>
        <h2>
            Lorem ipsum dolor sit amet. Qui vero dolorum est fugit quae eum incidunt voluptate est
            galisum dolorem? Qui nihil consequatur qui perspiciatis porro et velit illum. Qui culpa
            perferendis et architecto amet non nisi praesentium ut eveniet molestiae cum soluta sequi
            qui omnis ipsam est enim dolorem? Ut voluptatem voluptatem et explicabo facilis qui
            consequatur explicabo.
        </h2>
       
        <!-- <div style="height:400px;border:1px solid #ddd">
            <iframe src="http://localhost:3000/TelaNoticias" style="width:150%;height: 100%;border:0"></iframe>
        </div>  -->

        <br><br>
        <h3>Navegação Rápida</h3>
        <div class="cards">
            <a href="../app/controller/postNext.php">
                <div></div>
            </a>
            
            <a href="../app/controller/postNext.php">
                <div></div>
            </a>

            <a href="../app/controller/postNext.php?">
                <div></div>
            </a>
        </div>
       
        <br><br>
        <h3>Últimos Posts</h3>
        <div class="cards posts">
            <?php
                $caminho = "../data.json";
                if (file_exists($caminho)){
                    $dados = file_get_contents($caminho);
                    $dadosNjson = json_decode($dados, true);
                }
                if ($dadosNjson !== null && is_array($dadosNjson)):
                    $dadosLimit = array_slice($dadosNjson, 0, 5);
                foreach ($dadosLimit as $dado):
            ?> 

            <a href="http://localhost:3000/PaginaNoticia?id=<?php echo htmlspecialchars($dado['id_noticia']); ?>&fromTela=1">
                <div class="card.posts">
                    <?php if (!empty($dado['imagens'])): ?>
                        <?php foreach ($dado['imagens'] as $imagem): ?>
                            <img src="<?php  echo htmlspecialchars($imagem); ?>" alt="Imagem da Postagem" style="max-width: 100px;"/>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Sem imagem
                    <?php endif; ?>
                    <a href="router.php?action=noticias"><h2><?php echo htmlspecialchars($dado['titulo']); ?></h2></a>
                </div>
            </a>
            <?php endforeach; endif;?>
        </div><br><br><br><br>
 
        <br>
        <a href="https://www.instagram.com/hem.etec/">Siga-nos no Instagram</a>
        <a href="../public/router.php?action=cadastro">[cadastro]</a>   
        <br>
        <a href="https://github.com/MatheusLima1234/LevelTracks">GitHub do Hemetec</a>
        <br><br>
 
        <footer>
            2025 © HEMETEC - Todos os direitos reservados
        </footer>
    </div>
</body>
</html>
 
 
