<?php
require_once __DIR__ . "/../model/postagemModel.php";
require_once __DIR__ . "/postNext.php";
 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 
if (isset($_REQUEST["action"])) {
    try {
        $controller = new PostController();
        switch ($_REQUEST["action"]) {
            case 'cadastrar':
                $controller->cadastrar();
                break;
            case 'atualizar':
                $controller->alterarPost();
                break;
            case 'excluir':
                $controller->excluir();
                break;
        }
    } catch (Throwable $th) {
        echo json_encode(["status" => "erro", "message" => $th->getMessage()]);
    }
}
$nextPost = new NextPost();

class PostController {

    public function cadastrar() {

        $objPostagem = new postagemModel();
        $titulo = $_POST['ti'];
        $cont = $_POST['cont'];
        $img = $_FILES['img'] ?? null;
        $autor = $_POST['autor'];
        $visibilidade = true;
        $publicacao = true;
        $categoria = $_POST['cat'];

        $result = $objPostagem->tituloExiste($titulo);
        if($result['existe']){
            echo "<script> alert(" .$result['msg'] .")</script>";
        } else {
            /* --- Controle da imagem --- */
            if ($img && $img["error"] === UPLOAD_ERR_OK) {
                $extensaoImg = pathinfo($img["name"], PATHINFO_EXTENSION);
                $nomeId = uniqid("img_", true) . "." . $extensaoImg;
    
                // Caminho físico para salvar a imagem
                $destino = __DIR__ . '/../docs/imgs/' . $nomeId;
                if (move_uploaded_file($img['tmp_name'], $destino)) {
                    // Caminho relativo usado no JSON/Next
                    $imgUrl = 'app/docs/imgs/' . $nomeId;
                    $legenda = $img['name'];
                } else {
                    $erro ="imagem não suportada";
                }
            }
    
            /* --- Controle do texto --- */
            if (!empty($cont)) {
                $url = '../app/docs/arquivos/';
                $tituloLimpo = preg_replace("/[^a-zA-Z0-9_-]/", "", $titulo); 
                //sanitizar, tirar caracteres especiais
                
                $nomeTxt = uniqid("txt_", true) . $tituloLimpo . ".txt";
                $txtUrl = $url . $nomeTxt;
                if (!is_dir($url)) { // teste de existencia de diretório
                    mkdir($url, 0755, true);//permição de ler, escrever e editar
                }
                if (file_put_contents($txtUrl, $cont, LOCK_EX) === false) {
                    echo '<script>const erro = "Falha ao salvar o texto.");</script>';
                }
            }
          
            /* --- Salvar no banco --- */
            if (isset($titulo, $autor, $txtUrl)) {
              
                if ($objPostagem->cadastrar($titulo, $autor, $txtUrl, $imgUrl ?? null, $legenda ?? null, $extensaoImg ?? null, $visibilidade, $publicacao, $categoria)) {
                    echo "<script> alert('Cadastrado bem sucedido'); window.location.href = 'router.php?action=cad';</script>";
                } else {
                  	echo "<script> alert('Erro no cadastro!'); window.location.href = 'router.php?action=cad';</script>";
                }
            } else {
          		echo "<script> alert('Erro: dados obrigatórios ausentes!'); window.location.href = 'router.php?action=cad';</script>";
            }
        }
      
    }
 
    public function excluir() {
        if (!empty($_POST['idVer']) && !empty($_POST['idNot'])) {
            $objPostagem = new postagemModel();
            $objPostagem->Exc($_POST['idVer'], $_POST['idNot']);
          
            echo "<script> alert('Notícia excluída com sucesso'); window.location.href ='router.php?action=cons#Topo'</script>";
        } else {
            echo "<script>alert('ID da notícia não informado!');</script>";
        }
        // $nextPost->atualizar();

    }
 
    public function alterarPost() {
		if(empty($_POST['ti']) &&
          empty($_POST['cont']) &&
          empty($_POST['autor']) &&
          empty($_POST['id_versao']) &&
          empty($_POST['idNot']) &&
          empty($_POST['publicado'] )){
          	echo '<script>alert("Dados obrigatórios ausentes");</script>';
          	header("Location: router.php?action=alt");
          	exit;
        }
        $objPostagem = new postagemModel();
        $titulo = $_POST['ti'];
        $cont = $_POST['cont'];
        $img = $_FILES['img'] ?? null;
        $autor = $_POST['autor'];
        $txt_url = $_POST['txt_url'] ?? '';
        $img_url = $_POST['img_url'] ?? '';
        $id_versao = $_POST['id_versao'];
       	$idNot = $_POST['idNot'];
        $publicado = $_POST['publicado'];
      
      	error_log("erro:  " . $publicado);
      	error_log("erro2:   " . $idNot);
        /*$categoria = $_POST['cat'];*/
      	/*
      	if($publicado == true){
			$publicado = 1;
        } else {
         	$publicado = 2; 
        }*/
        // Atualiza imagem
        if ($img && $img["error"] === UPLOAD_ERR_OK) {
          $caminho = "../" . $img_url;
          error_log($caminho);
          if (file_exists($caminho)) {
            unlink($caminho);
          }

          $extensaoImg = pathinfo($img["name"], PATHINFO_EXTENSION);
          $nomeId = uniqid("img_", true) . "." . $extensaoImg;

          $destino = __DIR__ . '/../docs/imgs/' . $nomeId;
          if (move_uploaded_file($img['tmp_name'], $destino)) {
            $imgUrl = 'app/docs/imgs/' . $nomeId;
            $legenda = $img['name'];
            //echo '<script>alert("Imagem salva com sucesso!");</script>';
          } else {
            echo '<script>alert("Falha ao salvar a imagem.");</script>';
          }
        } else{
        	$imgUser = null;
          	$legenda = null;
          	$extensaoImg = null;
        }
 
        // Atualiza texto
        if (!empty($cont)) {
            if (file_exists($txt_url)) {
                unlink($txt_url);
            }
 		
            $url = '../app/docs/arquivos/';
            $tituloLimpo = preg_replace("/[^a-zA-Z0-9_-]/", "", $titulo);
            $nomeTxt = uniqid("txt_", true) . $tituloLimpo . ".txt";
            $txtUrl = $url . $nomeTxt;
 
            if (!is_dir($url)) {
                mkdir($url, 0755, true);
            }
 
            if (!file_put_contents($txtUrl, $cont, LOCK_EX)) {
                echo '<script>alert("Falha ao salvar o texto.");</script>';
            }
        } else {
            $txtUrl = $txt_url;
        }
 		error_log("erro3:   " . $idNot);
        // Atualiza no banco
        if ($id_versao && $objPostagem->atualizar($idNot, $id_versao, $titulo, $autor, $txtUrl ?? null, $imgUrl ?? null, $legenda ?? '', pathinfo($imgUrl, PATHINFO_EXTENSION) ?? null, $publicado)) {
           	echo "<script> alert('Notícia alterada com sucesso');</script>";
            //header("Location: router.php?action=cons");
        } else {
            echo '<script>alert("erro na atualização");</script>';
          	//header("Location: router.php?action=cons");
        }
        // $nextPost->atualizar();
    }
   
}
?>