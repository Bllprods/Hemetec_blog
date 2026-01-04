<?php

class Conexao {
    private $pdo;
    private $port = 3306;
    private $host = "localhost";

    private $dbname = "hemetec";
    private $user = "root";
    private $senha = "";


    public function conectar() {

        //$dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}";

        try {
            // $this->pdo = new PDO($dsn, $this->user, $this->senha, $this->options);
            $this->pdo = new PDO("mysql:dbname=".$this->dbname.";host=".$this->host 
            ,$this->user, $this->senha);
        } catch (PDOException $e) {
            echo "ERRO DE CONEXÃO NO PDO: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "ERRO não passou da conexão: " . $e->getMessage();
            exit();
        }
        return $this->pdo;
    }
}

?>