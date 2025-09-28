<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Admin.css">
    <title>Área do Administrador</title>
</head>
<body>
    <?php 
        if (!isset($action) && isset($_GET['action'])) {
            $action = $_GET['action'];
        }
        include "Layout/Header.php";
        if($_SESSION['nivel_acesso'] === 1){
            $isEditor = false;
        } else{
            $isEditor = true;
        }

        ?>
        
        <div id="Corpo">
        <h1>Área do Administrador</h1>

            <div id="Topo">
                <a href="router.php?action=cons">
                    <button >Postagens</button>
                </a>
                <a href="router.php?action=adm">
                    <button <?php if ($isEditor){ echo 'disabled';} ?>>Administração</button>
                </a>
                <button type="submit" <?php if ($isEditor){ echo 'disabled';} ?>>Estatísticas</button>
            

            
                <a href="router.php?action=cad">
                    <button type="submit">Nova</button>
                </a>
            </div>


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
                }
                ?>

    </div>
    
</body>
</html>
