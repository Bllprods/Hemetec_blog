<?php 
// Definir o caminho base
define('BASE_PATH', __DIR__ . '/../');

// Incluir os controladores
require_once BASE_PATH . 'app/controller/homeController.php';
require_once BASE_PATH . 'app/controller/postController.php';
require_once BASE_PATH . 'app/controller/loginController.php';
require_once BASE_PATH . 'app/controller/cadastroUser.php';
// Criar as instâncias dos controladores
$homeController = new homeController();
$postController = new postController();
$loginController = new logon();
$cadController = new Cad();

// Pegando a acao
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
    case 'logar':
        $loginController->L();
        break;
    case 'cad':
    case 'alt':
    case 'exc':
        include BASE_PATH . "app/view/Admin.php";
        break;
    default:
        $postController->index();
        break;
}


?>