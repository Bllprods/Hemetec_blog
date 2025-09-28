<?php


class AdminModel {
    private $con;
    private $senhaHash;
    public function __construct() {
        require_once __DIR__ . '/conexao.php';
        $classe_con = new conexao();
        $this->con = $classe_con->conectar();
    }

    // essa merda toda é o Login 
    // Caramba que agrevidade em Bryan lopes Rodrigues
    public function buscarEmail($login) {
        $sql = "SELECT * FROM ADM WHERE email = :e";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':e', $login); //contra o SQL injection
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC); // resultado por nome de coluna e não indice, segundo o Google.
        if ($resultado) {
            $this->senhaHash = $resultado['senha_hash'];
            return true;
        }
        return false;
    }

    public function buscaNome($login) {
        $sql = "SELECT * FROM ADM WHERE nome = :n";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':n', $login);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC); // resultado por nome de coluna e não indice, segundo o Google.
        if ($resultado) {
            $this->senhaHash = $resultado['senha_hash'];
            return true;
        }
        return false;
    }


    public function verificarSenha($senhaDigitada) {
        if (empty($this->senhaHash)) {
            return false;
        }
        //descripta a senha, função propria do PHP
        return password_verify($senhaDigitada, $this->senhaHash);
    }

    public function newsection($login) {
        $sql = "SELECT nome, email, nivel_acesso, id_adm FROM ADM WHERE email = ? OR nome = ?";
        $stmt = $this->con->prepare($sql);
        $value = array($login, $login);
        $stmt->execute($value);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['nivel_acesso'] = $usuario['nivel_acesso'];
            $_SESSION['idAdm'] = $usuario['id_adm'];
            return true;
        }
        return false;
    }

    // fim login;


    // inicio Cadastro de Admin
  public function verificarEmailExistente($email) {
        // o Count, testa a quantidade de valores que atendem a condição "https://www.w3schools.com/sql/sql_count.asp"
        $sql = "SELECT * FROM ADM WHERE email = :e";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':e', $email);
        $stmt->execute();
        //https://www-php-net.translate.goog/manual/en/pdostatement.fetchcolumn.php?_x_tr_sl=en&_x_tr_tl=pt&_x_tr_hl=pt&_x_tr_pto=tc
        return $stmt->fetchColumn() > 0;
    }

    public function verificarUsuarioExistente($nomeDeUsuario) {
        $sql = "SELECT * FROM ADM WHERE nome = :n";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':n', $nomeDeUsuario);
        $stmt->execute();
        //basicamente, se existem volta true, ou seja, cadastro é barrado
        return $stmt->fetchColumn() > 0;
    }

    public function salvarUsuario($nomeDeUsuario, $email, $senha, $nivelAcesso) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO ADM (nome, email, senha_hash, nivel_acesso) VALUES (?,?,?,?)";
        $stmt = $this->con->prepare($sql);
        $valores = array($nomeDeUsuario, $email, $senhaHash, $nivelAcesso);
        return $stmt->execute($valores);
    }
    // fim cadastro de Admin


    public function consultaAdm(){

        try {
            $sql = "SELECT id_adm, nome, email, nivel_acesso, ativo FROM ADM ORDER BY nivel_acesso DESC";
            $stmtAdm = $this->con->prepare($sql);
            $stmtAdm->execute();
            
            // Retorna todos os resultados de uma vez
            return $stmtAdm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
            return []; 
        }
    }

    public function alterarAdm($id_adm, $nome, $email, $nivel_acesso){
            $sql = "UPDATE ADM SET nome = ?, email = ?, nivel_acesso = ?  WHERE id_adm = ?";
            $stmt = $this->con->prepare($sql);
            $valores = array($nome, $email, $nivel_acesso, $id_adm);
            $stmt->execute($valores);
            
            if ($id_adm === $_SESSION['idAdm']) {
                $this->newsection($email);
            }
    }
    public function excluirAdm($id_adm){
        $sql = "DELETE FROM ADM WHERE id_adm = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$id_adm]);
    }
} 