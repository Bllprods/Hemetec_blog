<?php

require_once __DIR__ . '/../model/conexao.php';
require_once __DIR__ . '/../model/AdminModel.php';

class Cad
{
    public function C()
    {
        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomeDeUsuario = trim($_POST['nome_de_usuario'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';
            $confirmaSenha = $_POST['confirma_senha'] ?? '';
            $nivelAcesso = $_POST['nivelAcesso'] ?? '2';

            if (empty($nomeDeUsuario) || empty($email) || empty($senha) || empty($confirmaSenha || empty($nivelAcesso))) {
                $erro = "Por favor, preencha todos os campos.";
            } elseif ($senha !== $confirmaSenha) {
                $erro = "As senhas não coincidem. Por favor, digite novamente.";
            } else {
                $modelLogin = new AdminModel();
                // métodos de cadastro
                if ($modelLogin->verificarEmailExistente($email)) {
                    $erro = "Este e-mail já está cadastrado.";
                } elseif ($modelLogin->verificarUsuarioExistente($nomeDeUsuario)) {
                    $erro = "Este nome de usuário Indisponivel";
                } else {
                    if ($modelLogin->salvarUsuario($nomeDeUsuario, $email, $senha, $nivelAcesso)) {
                        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='router.php?action=Admin';</script>";
                        exit;
                    } else {
                        $erro = "Erro ao cadastrar. Tente novamente mais tarde.";
                    }
                }
            }
        }
        echo "<script>alert('" . htmlspecialchars($erro) . "');  window.location.href='router.php?action=cadastro'</script> ";
    }

}
