<?php
require_once __DIR__ . "/../model/postagemModel.php";
// Que Comentários?
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
                    $controller->atualizar();
                    break;
                case 'excluir':
                    $controller->excluir();
                    break;
            }
        } catch (Throwable $th) {
            echo json_encode(["status" => "erro", "message" => $th->getMessage()]);
        }

    }
// I love you bryan
class PostController
{
    public function cadastrar()
    {
        $objPostagem = new postagemModel();
        $titulo = $_POST['ti'];
        // $autor = $_POST['autor']; O ID DO AUTOR É PEGO NO MODEL
        $cont = $_POST['cont'];
        // $fileCont = $_FILES['fileCont'];
        $img = $_FILES['img'] ?? null;

        // instancias para tabela noticia
        $visibilidade = false;
        $publicacao = false;

        /* --- Controle da imagem --- */
        if ($img && $img["error"] === UPLOAD_ERR_OK) {
            $extensaoImg = pathinfo($img["name"], PATHINFO_EXTENSION);
            $nomeId = uniqid("img_", true) . "." . $extensaoImg;
            $url = '../app/docs/imgs/';

            if (move_uploaded_file($img['tmp_name'], $url . $nomeId)) {
                $imgUrl = $url . $nomeId;
                $legenda = $img['name'];
                echo '<script>alert("Imagem salva com sucesso!");</script>';
            }
        }

        /* --- Controle do texto --- */
        if (!empty($cont)) {
            $url = '../app/docs/arquivos/';
            $tituloLimpo = preg_replace("/[^a-zA-Z0-9_-]/", "", $titulo);
            $nomeTxt = uniqid("txt_", true) . $tituloLimpo . ".txt";
            file_put_contents($url . $nomeTxt, $cont);

            $txtUrl = $url . $nomeTxt;
            $autor = $_SESSION['email'];
            echo '<script>alert("Texto salvo com sucesso!");</script>';

        }

        /* --- Salvar no banco --- */
        if (isset($titulo, $autor, $txtUrl)) {
            if ($objPostagem->cadastrar($titulo, $autor, $txtUrl, $imgUrl ?? null, $legenda ?? null, $extensaoImg ?? null, $visibilidade, $publicacao)) { //ERRO NESSA LINHA
                echo "Notícia cadastrada com sucesso!";
            } else {
                echo "Erro no cadastro!";
            }
        } else {
            echo "Erro: dados obrigatórios ausentes!";
        }

        header("Location: router.php?action=Admin");
        exit;
    }

    public function excluir(){

            if (!empty($_POST['idVer'])) {
                $objPostagem = new postagemModel();
                $objPostagem->Exc($_POST['idVer']);
                echo "<script>alert('Postagem excluída!');</script>";
            } else {
                echo "<script>alert('ID da notícia não informado!');</script>";
            }
    }

    public function alterarPost() {
        $objPostagem = new postagemModel();

        $titulo = $_POST['ti'];
        // $autor = $_POST['autor']; O ID DO AUTOR É PEGO NO MODEL
        $cont = $_POST['cont'];
        // $fileCont = $_FILES['fileCont'];
        $img = $_FILES['img'] ?? null;
        $txt_url = $_POST['txt_url'];
        $img_url = $_POST['img_url'];
        // Verifica se os dados necessários foram enviados
        if ( isset($_POST['id_versao']) && isset($_POST['ti']) && isset($_POST['cont']) && isset($_FILES['img'])) {
            $titulo     =    $_POST['ti'];
            $id_versao  =    $_POST['id_versao'];
            $cont       =    $_POST['cont'];
            $img        =    $_FILES['img'];
            $imgbd = $img_url;
            $imgUrl = $imgbd;
            // echo "<pre>";
            //     var_dump([
            //         'id_versao' => $_POST['id_versao'] ?? null,
            //         'titulo' => $titulo,
            //         'conteudo' => $cont,
            //         'img' => $img,
            //         'txt_url' => $txt_url,
            //         'img_url' => $img_url,
            //         'publicado' => $_POST['publicado'] ?? null,
            //         'autor' => $_SESSION['email'] ?? null
            //     ]);
            // echo "</pre>";

        
            if ($img && $img["error"] === UPLOAD_ERR_OK) {
                if (file_exists($imgbd)) {
                    unlink($imgbd);
                }
                $extensaoImg = pathinfo($img["name"], PATHINFO_EXTENSION);
                $nomeId = uniqid("img_", true) . "." . $extensaoImg;
                $url = '../app/docs/imgs/';

                if (move_uploaded_file($img['tmp_name'], $url . $nomeId)) {
                    $imgUrl = $url . $nomeId;
                    $legenda = $img['name'];
                    echo '<script>alert("Imagem salva com sucesso!");</script>';
                }
            }

            // Atualiza o texto se houve alteração
            if (!empty($cont)) {
                // Deleta o arquivo de texto antigo
                if (file_exists($txt_url)) {
                    unlink($txt_url);
                }
                // Gera novo nome e salva novo conteúdo
                $url = '../app/docs/arquivos/';
                $tituloLimpo = preg_replace("/[^a-zA-Z0-9_-]/", "", $titulo);
                $nomeTxt = uniqid("txt_", true) . $tituloLimpo . ".txt";
                $txtUrl = $url . $nomeTxt;

                // garante que o diretório exista (pequena checagem, não altera estrutura)
                if (!is_dir($url)) {
                    mkdir($url, 0755, true);
                }

                // === CORREÇÃO: passar o conteúdo como 2º argumento ===
                if (file_put_contents($txtUrl, $cont, LOCK_EX) === false) {
                    echo '<script>alert("Falha ao salvar o texto.");</script>';
                } else {
                    echo '<script>alert("Texto salvo com sucesso!");</script>';
                }
                } else {
                $txtUrl = $txt_url;
                echo '<script>alert("Conteúdo do texto não foi alterado.");</script>';
                }}
            // ... resto da função permanece igual (tratamento de imagem / atualização no model)


            
            $legenda = $img['name'] ?? "alguma img ai";
            $publicacao = filter_var($_POST['publicado'] ?? 'false', FILTER_VALIDATE_BOOLEAN);
            $autor = $_SESSION['email'] ?? 'Autor Desconhecido';
            // echo "<pre>";
            //     var_dump ($img, $imgbd, $imgUrl, $extensaoImg);
            // echo "</pre>";

        
            if ($objPostagem->atualizar($id_versao, $titulo, $autor, $txtUrl, $imgUrl, $legenda, $extensaoImg, $publicacao)) {
                echo "<script>alert('Notícia atualizada com sucesso!');</script>";
                header("Location: router.php?action=adminPost");
            }
            else {
                echo '<script>alert("Dados obrigatórios ausentes!");</script>';
                return;
                exit;
            }
        }
}

?>
