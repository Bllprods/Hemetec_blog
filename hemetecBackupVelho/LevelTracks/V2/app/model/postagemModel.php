<?php
class postagemModel {
    public $titulo;
    public $idAutor;
    public $cont;
    public $imgUrl;
    public $Legenda;
    public $id_noticia;
    private $con;

    public function __construct() {
        require_once __DIR__ . '/conexao.php';
        $classe_con = new conexao();
        $this->con = $classe_con->conectar();
    }

    public function cadastrar($titulo, $idAutor, $cont, $imgUrl, $Legenda) {
        // notícia e o id gerado
        $notSql = "INSERT INTO Noticia (titulo, id_autor) VALUES (?, ?)";
        $valores = array($this->titulo, $this->idAutor);
        $exec = $this->con->prepare($notSql);
        $exec->execute($valores);

        $id_noticia = $this->con->lastInsertId();

        // conteudo se notnull
        if (!empty($this->cont)) {
            $textSql = "INSERT INTO Texto (conteudo, id_noticia) VALUES (?, ?)";
            $valoresText = array($this->cont, $id_noticia);
            $execT = $this->con->prepare($textSql);
            $execT->execute($valoresText);
        }
    
        //  imagem 
        if (!empty($this->imgUrl)) {
            $imgSql = "INSERT INTO Imagem (imgurl, legenda, id_noticia) VALUES (?, ?, ?)";
            $valoresImg = array($this->imgUrl, $this->Legenda, $id_noticia);
            $execImg = $this->con->prepare($imgSql);
            $execImg->execute($valoresImg);
        }
        
    }



    public function atualizar($id_noticia) {

    }

    public function Exc($idNoticia)
    {
        if (!empty($idNoticia)) {
            // imagens relacionadas
            $imgSql = "DELETE FROM Imagem WHERE id_noticia = ?";
            $stmtImg = $this->con->prepare($imgSql);
            $stmtImg->execute([$idNoticia]);

            // textos relacionados
            $textSql = "DELETE FROM Texto WHERE id_noticia = ?";
            $stmtText = $this->con->prepare($textSql);
            $stmtText->execute([$idNoticia]);

            // notícia
            $notSql = "DELETE FROM Noticia WHERE id_noticia = ?";
            $stmtNot = $this->con->prepare($notSql);
            $stmtNot->execute([$idNoticia]);
            echo "
            <script>
            alert('exclusão completa!');
            </script>";
            header("Location: router.php?action=Admin");
        } else {
            echo "
            <script>
            alert('Falha na exclusão');
            </script>";
        }
    }
}

?>