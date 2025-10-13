<?php
require_once __DIR__ . '/../model/conexao.php'; 
require_once __DIR__ . '/../model/loginModel.php'; 

class logon{
    public function L()
    {
    
        //testar a sessão, se n, criar uma nova.
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $erro = '';
    //trim, remove espaço em branco do inicio ou fim
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');

        //testando os dados e verificando o BD
        if (!empty($login) && !empty($senha)) {
            $modeloLogin = new Login();
            
            if ($modeloLogin->buscarEmail($login)) {
                if ($modeloLogin->verificarSenha($senha)) {
                    //criando variavel de sessão e dano o valor do email
                    $_SESSION['usuarioLogado'] = $login;
                    echo "<script>alert('Logado');</script>";
                    header('Location: router.php?action=Admin');
                } else {
                    $erro = "Nome de usuário ou senha incorretos.";
                }
            } else {
                $erro = "Nome de usuário ou senha incorretos.";
            }
        } else {
            // Campos vazios
            $erro = "Por favor, preencha todos os campos.";
        }
        echo "<script> alert('". $erro ."')</script>";
    }
}
}
