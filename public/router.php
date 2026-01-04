<?php 
// Definir o caminho base
define('BASE_PATH', __DIR__ . '/../');

require_once BASE_PATH . 'app/controller/homeController.php';
require_once BASE_PATH . 'app/controller/postController.php';
require_once BASE_PATH . 'app/controller/loginController.php';
require_once BASE_PATH . 'app/controller/cadastroUser.php';    
require_once BASE_PATH . 'app/model/AdminModel.php';

$homeController = new homeController();
$postController = new postController();
$loginController = new logon();
$cadController = new Cad();

$admin = new AdminModel();
$admin->superAdm();


$action = $_GET['action'] ?? 'index';

	
$protocolo = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";

$url = $protocolo . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (session_status() === PHP_SESSION_NONE){
	session_start();
}

if( (str_contains($url, "?action=Admin") || str_contains($url, "?action=adm") ||
   str_contains($url, "?action=user") || str_contains($url, "?action=altAdm") ||
   str_contains($url, "?action=cons") || str_contains($url, "?action=exc") ||
   str_contains($url, "?action=alt") || str_contains($url, "?action=cad") ) &&
   (empty($_SESSION['nivel_acesso']) || empty($_SESSION['nome']) || empty($_SESSION['email']) ) ){
  	echo "<script> alert('Acesso negado!!');
  		window.location.href = 'router.php?action=index';</script>";
  	flush();// forçar envio 
} else if ((str_contains($url, "?action=adm") ||
     str_contains($url, "?action=altadm") ||
     str_contains($url, "?action=excluirAdm"))
    && isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] == 2) {
    echo "<script>
        alert('Acesso negado!!');
        window.location.href = 'router.php?action=index';
    </script>";
    exit;
}

//verificar se admin existe sempre
$user = $_SESSION['nome'];
$email = $_SESSION['email'];
$tipo = $_SESSION['nivel_acesso'];
$dadosBd = $admin->consultaAdm();
$valido = false;

if ($user && $email && $tipo) {
    foreach($dadosBd as $d){
        if((isset($d['nome']) && isset($d['email']) && isset($d['nivel_acesso'])) && 
            $d['nome'] === $user && $d['email'] === $email && $d['nivel_acesso'] === $tipo){
            $valido = true;
            break;
        } 
    }
} else {
    $valido = false; 
}
// se n verificar os dados da sessão o usuario comum tava sendo tirado junto
if(!$valido && ($user || $email || $tipo)){
    session_unset();
    session_destroy();
    header("location: router.php?action=index");
    exit;
}
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
  	case 'esqueciSenha':
    	$homeController->esqueciSenha();
    	break;
    case 'cad':
    case 'alt':
    case 'exc':
    case 'cons':
    case 'adm':
    case 'altAdm':
  	case 'user':
        include BASE_PATH . "/app/view/Admin.php";
        break;
  	default:
        $homeController->index();
        break;
    }
?>

<script src="../app/view/script.js"></script>
<script src="https://cdn.userway.org/widget.js" data-account="VuyKtNfCkR"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const params = new URLSearchParams(window.location.search);
        const produtoId = params.get('act');

        if(produtoId === "vfc") {
            const codediv = document.getElementById("codediv");
            const corpoRedSenha = document.getElementById("corpoRedSenha");
			const emaildiv = document.getElementById("emaildiv");
            if (codediv && corpoRedSenha && emaildiv) {
                corpoRedSenha.style.display = 'block';
              	emaildiv.style.display = 'none';
                codediv.style.display = 'block';
            }
        }
    });
    </script>
<!-- ========================= AREA LIBRAS ========================= -->
<div vw class="enabled">
   <div vw-access-button class="active"></div>
   <div vw-plugin-wrapper>
     <div class="vw-plugin-top-wrapper"></div>
   </div>
 </div>

 <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
   new window.VLibras.Widget('https://vlibras.gov.br/app');
 </script>
<!-- ======================= FIM AREA LIBRAS ======================= -->
