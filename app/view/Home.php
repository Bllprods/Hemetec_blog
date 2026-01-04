<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Home.css">
    <link rel="stylesheet" href="css/Fontes.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" href="imagens/logoIco.ico">
    <title>Home</title>
  <?php require_once  __DIR__ . "/../view/Login.php" ;
    	require_once __DIR__ . "/../view/esqueciSenha.php";?>
        <?php
  			$headerPath = __DIR__ . "/../../public/layout/Header.php"; // ajusta conforme estrutura do seu projeto
            if (file_exists($headerPath)) {
                include_once $headerPath;
            } else {
                error_log("Header não encontrado: $headerPath");
            }

        ?>
</head>
<body>

  <div><br><br>
         
  </div>
  		<!--<a href="router.php?action=index&act=vfc">code</a>-->
        <div id ="Corpo">
        <h1>Seja bem-vindo ao Hemetec</h1>
        <h2>
            Lorem ipsum dolor sit amet. Qui vero dolorum est fugit quae eum incidunt voluptate est
            galisum dolorem? Qui nihil consequatur qui perspiciatis porro et velit illum. Qui culpa
            perferendis et architecto amet non nisi praesentium ut eveniet molestiae cum soluta sequi
            qui omnis ipsam est enim dolorem? Ut voluptatem voluptatem et explicabo facilis qui
            consequatur explicabo.
        </h2>

        <br><br>
        <h3>Navegação Rápida</h3>
        <div class="cards">
            <a href="../app/controller/postNext.php?action=chamar">
                <div></div>
            </a>
            
            <a href="../app/controller/postNext.php?action=chamar">
                <div></div>
            </a>

            <a href="../app/controller/postNext.php?action=chamar">
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

            <a href="http://localhost:3000/PaginaNoticia/<?php echo htmlspecialchars($dado['id_noticia']); ?>?fromTela=1">
              <?php if ($dado['publicado'] == 1):?>
                <div class="card.posts">
                  
                    <?php if (!empty($dado['imagens'])): ?>
                        <?php foreach ($dado['imagens'] as $imagem): 
                            ?>
                            <img src="<?php  echo htmlspecialchars($imagem); ?>" alt="Imagem da Postagem" style="max-width: 100px;"/>
                            <h2><?php echo htmlspecialchars($dado['titulo']); ?></h2>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Sem imagem
                    <?php endif; ?>
                  
                </div>
              <?php endif;?>
            </a>
            <?php endforeach; endif;?>
        </div>
          
        <?php include "layout/Footer.php";?>
           
		
  	</div>
	</body>
</html>
 
 
