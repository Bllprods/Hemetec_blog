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
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['usuarioLogado'])) {
                var_dump ("Usuário logado: " . $_SESSION['usuarioLogado']);
            } else {
                var_dump ("Nenhum usuário logado");
            }
        ?>
    <?php include "Layout/Header.php";?>
    
    <div id="Corpo">
        <h1>Área do Administrador</h1>

         <div id="Topo">
            <button>Postagens</button>
            <button>Administração</button>
            <button>Estatísticas</button>
        </div>

        <div id="opcao">
            <a href="router.php?action=cad">
                <button type="submit">Nova</button>
            </a>

            <a href="router.php?action=alt">
                <button type="submit">Alterar</button>
            </a>

            <a href="router.php?action=exc">
                <button type="submit">Excluir</button>
            </a>
        </div>

           <?php
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'cad':
                            include __DIR__ . "/../../public/layout/adminPost.php";
                            break;
                        case 'alt':
                            include __DIR__ . "/../../public/layout/adminAlt.php";
                            break;
                        case 'exc':
                            include __DIR__ . "/../../public/layout/adminExc.php";
                            break;
                    }
                }
                ?>

    </div>
    
</body>
</html>
