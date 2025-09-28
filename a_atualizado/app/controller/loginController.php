<?php
require_once __DIR__ . '/../model/conexao.php'; 
require_once __DIR__ . '/../model/AdminModel.php'; 

class logon{
    public function L()
    {
        $modeloLogin = new AdminModel();
// q legal
        //testar a sessão, se n, criar uma nova.
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $erro = '';
        //trim, remove espaço em branco do inicio ou fim
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['email'] ?? '');
            $senhaHash = trim($_POST['senha'] ?? '');

            //testando os dados e verificando o BD
            if (!empty($login) && !empty($senhaHash)) {
                if ($modeloLogin->buscarEmail($login) || $modeloLogin->buscaNome($login)){
                    if ($modeloLogin->verificarSenha($senhaHash)) {
                        //criando variavel de sessão e dando o valor do email
                        if ($modeloLogin->newsection($login)) {
                            header("Location: ../public/router.php?action=index");
                        }
                    } else {
                        $erro = " senha incorreta";
                    }
                } else {
                    $erro = "Nome de usuário ou senha incorretos!";
                }
            } else {
                // Campos vazios
                $erro = "Por favor, preencha todos os campos.";
            }
            if (isset($erro)) {
                echo "<script> alert('". $erro ."'); window.location.href='router.php?action=login'</script>";

            }
        }
    }
    public function LG(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset(); // limpa a sessão
        session_destroy(); // destrói a sessão
        header("Location: router.php?action=index");
    }
    public function alterarAdm(){
            $modeloLogin = new AdminModel();

            $id_adm = trim($_POST['id_adm'] ?? '');
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $nivel_acesso = trim($_POST['nivel_acesso'] ?? '');

            if (empty($id_adm) || empty($nome) || empty($email) || empty($nivel_acesso)) {
                $erro = "Por favor, preencha todos os campos.";
                echo "<script> alert('". $erro ."'); window.location.href='router.php?action=alterarAdm'</script>";
            } else {
                $modeloLogin->alterarAdm($id_adm, $nome, $email, $nivel_acesso);
                echo "<script> alert('Administrador alterado com sucesso!'); window.location.href='router.php?action=index'</script>";
            }
    }
    public function excluirAdm(){
        $modeloLogin = new AdminModel();

        $id_adm = trim($_POST['idAdm'] ?? '');

        if (empty($id_adm)) {
            $erro = "ID do administrador não informado.";
            echo "<script> alert('". $erro ."'); window.location.href='router.php?action=excluirAdm'</script>";
        } else {
            $modeloLogin->excluirAdm($id_adm);
            echo "<script> alert('Administrador excluído com sucesso!'); window.location.href='router.php?action=index'</script>";
        }
    }
}
?>