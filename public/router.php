<?php 
// Definir o caminho base
define('BASE_PATH', __DIR__ . '/../');

require_once BASE_PATH . 'app/controller/homeController.php';
require_once BASE_PATH . 'app/controller/postController.php';
require_once BASE_PATH . 'app/controller/loginController.php';
require_once BASE_PATH . 'app/controller/cadastroUser.php';    

$homeController = new homeController();
$postController = new postController();
$loginController = new logon();
$cadController = new Cad();


$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $homeController->index();
        break;
    case 'login':
        $homeController->login();
        break;
    case 'Admin':
        $homeController->admin();
        break;
    case 'noticias':
        $homeController->notice();
        break;
    case 'value':
        $homeController->postagens();
        break;
    case "cadastro":
        $homeController->cadastroUser();
        break;
    case 'cadastraU':
        $cadController->C();
        break;
    case 'cadastrar':
        $postController->cadastrar();
        break;
    case 'excluir':
        $postController->excluir();
        break;
    case 'alterarPost':
        $postController->alterarPost();
        break;
    case 'logar':
        $loginController->L();
        break;
    case 'logout':
        //echo "logot";
        $loginController->LG();
        break;
    case 'alterarAdm':
        $loginController->alterarAdm();
        break;
    case 'excluirAdm':
        $loginController->excluirAdm();
        break;
    case 'cad':
    case 'alt':
    case 'exc':
    case 'cons':
    case 'adm':
    case 'altAdm':
        include BASE_PATH . "/app/view/Admin.php";
        break;
    default:
        $homeController->index();
        break;
    }
?>

<script src="../app/view/script.js"></script>

<script src="https://cdn.userway.org/widget.js" data-account="VuyKtNfCkR"></script>


<!-- ========================= AREA LIBRAS ========================= -->
<div vw class="enabled">
   <div vw-access-button class="active"></div>
   <div vw-plugin-wrapper>
     <div class="vw-plugin-top-wrapper"></div>
   </div>
 </div>

 <script src="../app/vlibras-plugin.js"></script>
 <script>
   new window.VLibras.Widget('https://vlibras.gov.br/app');
 </script>
<!-- ======================= FIM AREA LIBRAS ======================= -->
