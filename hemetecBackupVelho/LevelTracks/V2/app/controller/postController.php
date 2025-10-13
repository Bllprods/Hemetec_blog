<?php
require_once __DIR__ . "/../model/postagemModel.php";

class PostController
{
    public function cadastrar()
    {
        $objPostagem = new postagemModel();
        $objPostagem-> titulo = $_POST['ti'];
        $objPostagem-> cont = $_POST['cont'];
        $objPostagem-> idAutor = $_POST['idAutor'];

        $img = $_FILES['img'];
        $extensao = pathinfo($img["name"], PATHINFO_EXTENSION);
        $nomeId = uniqid() . "." . $extensao;
        $url = '../app/view/img/';
        if (move_uploaded_file($img['tmp_name'], $url.$nomeId)) {
            $objPostagem->imgUrl = $url;
            $objPostagem->Legenda = $_FILES['img']['name'];
            echo '
            <script type="text/javascript">
                alert("Salvo com Sucesso !");
            </script>';
        };

        if ($objPostagem ->cadastrar($objPostagem->titulo, $objPostagem->idAutor, $objPostagem->cont, $imgUrl, $Legenda)) {
            echo "noticia cadastrada com sucesso!";
        } else {
            echo "erro no cadastro";
        }
        
    header("Location: router.php?action=Admin");
    }

    public function atualizar()
    {

    }

    public function excluir()
    {
        var_dump($_POST['idNot']);
        if (!empty($_POST['idNot'])) {
            $objPostagem = new postagemModel();
            $objPostagem->Exc($_POST['idNot']);
            echo "<script>alert('Postagem Excluida');</script>";
        } else {
            echo "<script>alert('ID da notícia não informado!');</script>";
        }   
    }

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
?>