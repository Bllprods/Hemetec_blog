<?php

class Login {
    private $conexao;
    private $senhaHash;

    public function __construct() {
        require_once __DIR__ . '/conexao.php';
        $classe_con = new conexao();
        $this->conexao = $classe_con->conectar();
    }

    public function buscarEmail($email) {
        $sql = "SELECT senha FROM Usuario WHERE email = :email";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':email', $email); //contra o SQL injection
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC); // resultado por nome de coluna e não indice, segundo o Google.
        if ($resultado) {
            $this->senhaHash = $resultado['senha'];
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

    public function verificarEmailExistente($email) {
        // o Count, testa a quantidade de valores que atendem a condição "https://www.w3schools.com/sql/sql_count.asp"
        $sql = "SELECT COUNT(*) FROM Usuario WHERE email = :email";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        //https://www-php-net.translate.goog/manual/en/pdostatement.fetchcolumn.php?_x_tr_sl=en&_x_tr_tl=pt&_x_tr_hl=pt&_x_tr_pto=tc
        return $stmt->fetchColumn() > 0;
    }

    public function verificarUsuarioExistente($nomeDeUsuario) {
        $sql = "SELECT COUNT(*) FROM Usuario WHERE nome = :nome";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $nomeDeUsuario);
        $stmt->execute();
        //basicamente, se existem volta true, ou seja, cadastro é barrado
        return $stmt->fetchColumn() > 0;
    }

    public function salvarUsuario($nomeDeUsuario, $email, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $nomeDeUsuario);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senhaHash);
        return $stmt->execute();
    }
} 