<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="imagens/logoIco.ico">
    <title>Área do Administrador</title>
</head>
<body>
    <?php 
        if (!isset($action) && isset($_GET['action'])) {
            $action = $_GET['action'];
        }
        include "layout/Header.php";
        ?>
        <h1>Área do Administrador</h1>
        <div id="Corpo">
            <div id="Topo">
                <a href="router.php?action=index">
                    <button type="submit">Voltar</button>
                </a>
                <a href="router.php?action=user#Conteudo">
                    <button type="submit">Usuario</button>
                </a>
                <a href="router.php?action=cons#Conteudo">
                    <button >Postagens</button>
                </a>
              
                <a href="router.php?action=adm#Conteudo">
                    <button id="btnAdm">Administração</button>
                </a>

                <!-- <button type="submit" id>Estatísticas</button> -->
            
                <a href="router.php?action=cad#Conteudo">
                    <button type="submit">Nova</button>
                </a>
            </div>
		<div id="CorpoTodo">

           <?php
                switch ($action) {
                    case 'cad':
                        include __DIR__ . "/../../public/layout/adminPost.php";
                        break;
                    case 'alt':
                        include __DIR__ . "/../../public/layout/adminAlt.php";
                        break;
                    case 'exc':
                        include __DIR__ . "/../../public/layout/adminExc.php";
                        break;
                    case 'cons':
                        include __DIR__ . "/../../public/layout/adminCos.php";
                        break;
                    case 'adm':
                        include __DIR__ . "/../../public/layout/adminAdm.php";
                        break;
                    case 'altAdm':
                        include __DIR__ . "/../../public/layout/adminAdmAlt.php";
                        break;
                  	case 'user':
                		include __DIR__ . "/../../public/layout/adminUser.php";
                        break;
                }
                ?>
    </div>
    
       <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnAdm = document.getElementById("btnAdm");
            const isEditor = <?php echo $_SESSION['nivel_acesso'];?>;
            if (btnAdm && isEditor == 2) {
                btnAdm.disabled = true;
            }
        });
    </script>
</body>

</html>