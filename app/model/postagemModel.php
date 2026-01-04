<?php

class postagemModel {
    public $titulo;
    public $imgUrl;
    public $tamanho;
    public $txtUrl;
    public $autor;
    public $legenda;
    public $con;

    public function __construct() {
        require_once __DIR__ . '/conexao.php';
        $classe_con = new conexao();
        $this->con = $classe_con->conectar();
    }


    public function cadastrar($titulo, $autor, $txtUrl, $imgUrl, $legenda, $extensaoImg, $visibilidade, $publicacao, $categoria) {
        if (session_status() == PHP_SESSION_NONE) {     
            session_start();
        }
      try{
        if (!empty($_SESSION['email'])) {
            $stmt = $this->con->prepare("SELECT COUNT(*) FROM ADM WHERE email = ?");
            $stmt->execute([$_SESSION['email']]);
            $emailExists = $stmt->fetchColumn();
        }
                echo "<script>
                  alert(
                      'titulo: " . addslashes($titulo) . "\\n' +
                      'autor: " . addslashes($autor) . "\\n' +
                      'txtUrl: " . addslashes($txtUrl ?? '') . "\\n' +
                      'imgUrl: " . addslashes($imgUrl ?? '') . "\\n' +
                      'legenda: " . addslashes($legenda ?? '') . "\\n' +
                      'extensaoImg: " . addslashes($extensaoImg ?? '') . "\\n' +
                      'visibilidade: " . addslashes($visibilidade) . "\\n' +
                      'publicacao: " . addslashes($publicacao) . "\\n' +
                      'categoria: " . addslashes($categoria) . "'
                  );
                  </script>";
        if (!$emailExists) {
            session_destroy();
            header("Location: ../public/router.php?action=index");
        } else {
    
            //noticia
            //primaria
            $stmt = "INSERT INTO Noticia (publicado, visivel, categoria) VALUES (?, ?, ?)";
            $valores = array($publicacao, $visibilidade, $categoria); 
            $exec = $this->con->prepare($stmt);
            $exec->execute($valores);
            $id_noticia = $this->con->lastInsertId();

            //texto
            //primaria
            $stmt = "INSERT IGNORE INTO Texto (txt_url, titulo, autor) VALUES (?, ?, ?)";
            $valores = array($txtUrl, $titulo, $autor);
            $execT = $this->con->prepare($stmt);
            $execT->execute($valores);
            $id_texto = $this->con->lastInsertId(); 
            

            //img
            //primaria
            $stmt = "INSERT INTO Imagem (img_url, legenda, tamanho) VALUES (?, ?, ?)";
            $valores = array($imgUrl, $legenda, $extensaoImg);
            $execImg = $this->con->prepare($stmt);
            $execImg->execute($valores); // ERRO NESSA LINHA
            $id_imagem = $this->con->lastInsertId();
            // Insere na tabela Imagem, se houver imagem
            
            
            //noticia_versão
            //secundaria
            if (!empty($id_noticia)) {
                $stmt = "INSERT INTO noticia_versao (comentario_edicao, cod_version)
                        VALUES ('Versão inicial da notícia', 1)";
                $exec = $this->con->prepare($stmt);
                $exec->execute();
                /* lastInsertId é uma função sql/php se n me engano 
                que pega o ultimo id enviado, ent eu só consulto e instancio*/
                $id_versao = $this->con->lastInsertId();
            }

            
            //versionamento
            //segundaria
            if (!empty($id_versao) && !empty($id_noticia)) { 
                // versionamento
                $stmt = "INSERT INTO versionamento (id_noticia, id_versao) VALUES (?, ?)";
                $valores = array($id_noticia, $id_versao);
                $exec = $this->con->prepare($stmt);
                $exec->execute($valores);
                $id_versionamento = $this->con->lastInsertId();
            }
            
            /*------------------------------------------*/
            if (!empty($id_noticia) && !empty($_SESSION['idAdm'])) { //relação
                $stmt = "INSERT INTO vr_adm (id_noticia, acao, comentario, id_adm) VALUES (?, ?, ?, ?)";
                $valores = array($id_noticia, "cadastrar", "cadastro de nova postagem", $_SESSION['idAdm']);
                $exec = $this->con->prepare($stmt);
                $exec->execute($valores);
            }
    
            // Insere na tabela Texto
            if (!empty($id_texto) && !empty($id_versao)) {//relação
                $stmt = "INSERT INTO noticia_texto (id_texto, id_versao) VALUES (?, ?)";
                $valores = array($id_texto, $id_versao);
                $execT = $this->con->prepare($stmt);
                $execT->execute($valores);
            }
            
            if (!empty($id_imagem) && !empty($id_versao)) {//relação
                $stmt = "INSERT INTO noticia_imagem (id_imagem, id_versao) VALUES (?, ?)";
                $valores = array($id_imagem, $id_versao);
                $execT = $this->con->prepare($stmt);
                $execT->execute($valores);
            }
        }
       return true; 
      } catch (PDOException $e) {
          error_log($e->getMessage());
          return false; 
      }
      
    }

    /* ------------------------------------------------------------------ */
    public function atualizar($idNot, $id_versao, $titulo, $autor, $txtUrl, $imgUrl, $legenda, $extensaoImg, $publicado) {
        //subindo ao bd
     	 error_log("erro5:   " . $idNot);
      	$noticia = $idNot;
        $stmt = "UPDATE Noticia SET publicado = ? WHERE id_noticia = ?" ;
        $valores = array($publicado, $noticia); 
        $exec = $this->con->prepare($stmt);
        $exec->execute($valores);
      
      	if(!empty($idNot)){
          error_log("erroM2   " . $idNot);
      	} else{
          error_log("vazio");
        }
    	error_log("erroM:  " . $publicado);
      	
        $rowsAffected = $exec->rowCount();
        if ($rowsAffected >= 0) {
            $OkN = true;
        } else{
            echo "falhaN";
        }

        //Alterar Imagem
      	if (!empty($imgUrl) && 
            !empty($legenda) && 
            !empty($extensaoImg)){
          $stmtImagem = "UPDATE Imagem AS i INNER JOIN noticia_imagem AS ni ON i.id_imagem = ni.id_imagem SET i.img_url = ?, i.legenda = ?, i.tamanho = ? WHERE ni.id_versao = ?";
          $valorImagem = array($imgUrl, $legenda, $extensaoImg, $id_versao);
          $exeImagem = $this->con->prepare($stmtImagem);
          $exeImagem->execute($valorImagem);

          if ($exeImagem->rowCount() > 0) {
              $OkI = true;
          } else {
              echo "falhaI";
              $OkI = false;
          }
        } else{
          $OkI = true;
        }
        

        // Alterar Texto
        $stmtTexto = "UPDATE Texto AS T INNER JOIN noticia_texto AS nt ON T.id_texto = nt.id_texto 
                    SET T.titulo = ?, T.txt_url = ?, T.autor = ?  WHERE nt.id_versao = ?"; 
        $valorTexto = array($titulo, $txtUrl, $autor, $id_versao);
        $exeTexto = $this->con->prepare($stmtTexto);
        $exeTexto->execute($valorTexto); 
        if ($exeTexto->rowCount() > 0) {
            $OkT = true;
        } else {
          	echo "falhaT";
            $OkT = false;
        }
      // Alterar Versão
        error_log($idNot. "/n" . $id_versao);
        $stmtV = "UPDATE versionamento SET id_versao = ? WHERE id_noticia = ?"; 
        $valorV = array($id_versao, $idNot);
        $exeV = $this->con->prepare($stmtV);
        $exeV->execute($valorV); 
        if ($exeV->rowCount() > 0) {
            $OkV = true;
        } else {
          echo "falhaV";
            $OkV = false;
        }

        if (!$OkN || !$OkI || !$OkT || !$OkV) {
          	return false;
        } else {
            return true;
        }
  
    }



    public function Exc($idVer, $idNoticia) {
        if (!empty($idNoticia)) {
            // Deleta a notícia
            $stmt = "DELETE FROM Noticia WHERE id_noticia = ?";
            $stmtNot = $this->con->prepare($stmt);
            $stmtNot->execute([$idNoticia]);


            $stmt = "DELETE FROM noticia_versao WHERE id_versao NOT IN (SELECT id_versao FROM versionamento)";
            $stmtV = $this->con->prepare($stmt);
            $stmtV->execute();
            
            // deletar imagens que não estão mais vinculadas a nenhuma notícia
            $stmt = "DELETE FROM Imagem WHERE id_imagem NOT IN (SELECT id_imagem FROM noticia_imagem)";
            $stmtImg = $this->con->prepare($stmt);
            $stmtImg->execute();

            // deletar textos que não estão mais vinculados a nenhuma notícia
            $stmt ="DELETE FROM Texto WHERE id_texto NOT IN (SELECT id_texto FROM noticia_texto)";
            $stmtText = $this->con->prepare($stmt);
            $stmtText->execute();

            echo "<script>alert('Exclusão completa!');</script>";
        } else {
            echo "<script>alert('Falha na exclusão');</script>";
        }
    }

    public function consulta(){
       try {
            $sql = "SELECT id_noticia, criado_em, publicado, categoria FROM  Noticia ORDER BY criado_em DESC";
            $stmtNot = $this->con->prepare($sql);
            $stmtNot->execute();

            $postagens = $stmtNot->fetchAll(PDO::FETCH_ASSOC);
            
            $resultado = [];
            foreach ($postagens as $postagem) {
                $id_not = $postagem['id_noticia'];
                $texto = [];
                $imagens = [];
                
                // $sql = "SELECT categoria FROM Noticia WHERE id_noticia = ?";
                // $stmtc = $this->con->prepare($sql);
                // $stmtc-> execute([$id_not]);
                // $cat = $stmtc->fetchColumn();

                $sql = "SELECT id_versao FROM versionamento WHERE id_noticia = ?";
                $stmtV = $this->con->prepare($sql);
                $stmtV-> execute([$id_not]);
                $id_versao = $stmtV->fetchColumn();

                //https://www.devmedia.com.br/sql-inner-join/41230?gad_source=1&gad_campaignid=22326280955&gclid=CjwKCAjwobnGBhBNEiwAu2mpFMxaD0fGdEkZzDKYqtcLZXrxXanyKNwyiVzAwtAOcgJwlqKF0FD7XRoC4SoQAvD_BwE
                $sql = "SELECT T.titulo, T.txt_url, T.autor FROM Texto AS T INNER JOIN noticia_texto AS nt ON T.id_texto = nt.id_texto WHERE nt.id_versao = ?";
                $stmtT = $this->con->prepare($sql);
                $stmtT->execute([$id_versao]);
                $texto = $stmtT->fetch(PDO::FETCH_ASSOC) ?: [];

                $sql = "SELECT I.img_url FROM Imagem AS I INNER JOIN noticia_imagem AS ni ON I.id_imagem = ni.id_imagem WHERE ni.id_versao = ?";
                $stmtI = $this->con->prepare($sql);
                $stmtI->execute([$id_versao]);
                $imagens = $stmtI->fetchAll(PDO::FETCH_ASSOC);

                //https://www.php.net/manual/pt_BR/function.array-merge.php
                $dados = array_merge(
                    $postagem,
                    $texto,
                    ['id_noticia' => $id_not],
                    ['id_versao' => $id_versao],
                    ['imagens' => $imagens]
                    // ['cat' => $cat]
                );

                if (isset($dados) && !empty($dados)) {
                    $resultado[] = $dados;
                }

            }
            return $resultado;
            //return json_encode($resultado);
        } catch (PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
            return []; 
        }
    }
    public function tituloExiste($titulo){
        $sql = "SELECT COUNT(*) FROM Texto WHERE titulo = :titulo";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([':titulo' => $titulo]);
        $existe = $stmt->fetchColumn() > 0;
        $erro = "Este titulo já foi inserido";
      	if ($existe){
        	return ["existe" => $existe, "msg" => $erro];
        } else {
        	return ["existe" => $existe = false, "msg" => $erro];
        }
    }

}
?>
