<?php

require_once __DIR__ . '/../model/conexao.php';
require_once __DIR__ . '/../model/loginModel.php';

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

            if (empty($nomeDeUsuario) || empty($email) || empty($senha) || empty($confirmaSenha)) {
                $erro = "Por favor, preencha todos os campos.";
            } elseif ($senha !== $confirmaSenha) {
                $erro = "As senhas não coincidem. Por favor, digite novamente.";
            } else {
                $modelLogin = new Login();
                // Nomes dos métodos corrigidos para coincidir com o modelo
                if ($modelLogin->verificarEmailExistente($email)) {
                    $erro = "Este e-mail já está cadastrado.";
                    header('Location: router.php?action=cadastro');
                } elseif ($modelLogin->verificarUsuarioExistente($nomeDeUsuario)) {
                    $erro = "Este nome de usuário já está em uso.";
                    header('Location: router.php?action=cadastro');
                } else {
                    if ($modelLogin->salvarUsuario($nomeDeUsuario, $email, $senha)) {
                        header('Location: router.php?action=login');
                        exit();
                    } else {
                        $erro = "Erro ao cadastrar. Tente novamente mais tarde.";
                    }
                }
            }
        }
        echo "<script>alert('" . htmlspecialchars($erro) . "');</script>";
    }
}