<?php
require_once __DIR__ . '/../model/conexao.php'; 
require_once __DIR__ . '/../model/AdminModel.php'; 

class logon{
    public function L()
    {
        $modeloLogin = new AdminModel();
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
                        if ($modeloLogin->newsection($login)) {
                          	echo '<script> alert("Sucesso!!"); window.location.href = "router.php?action=Admin#Conteudo";</script>';
                    		exit;
                        }
                    } else {
                        echo "<script> alert('Senha Incorreta!');  window.location.href = 'router.php?action=index'; </script>";
                        exit;
                    }
                } else {
                    echo '<script> alert("Usuário não encontrado!!"); window.location.href = "router.php?action=index";</script>';
                    exit;
                }
            } else {
                echo '<script> alert("Preencha todos os campos!"); window.location.href = "router.php?action=index";</script>';
                exit;
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
			
      		error_log("id: " . $id_adm ."\n nome: " . $nome . "\n email: " . $email . "\n nivel acesso: " . $nivel_acesso);
      
            if (empty($id_adm) || empty($nome) || empty($email) || empty($nivel_acesso)) {
                $erro = "Por favor, preencha todos os campos.";
                echo "<script> const erro ='". $erro ."';</script>";
            } else {
                $modeloLogin->alterarAdm($id_adm, $nome, $email, $nivel_acesso);
                echo "<script> window.location.href='router.php?action=adm#Conteudo';</script>";
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
  
  	public function esqueciSenha($email, $senha){
    	$modeloLogin = new AdminModel();
      	//echo "<script>alert('".$email." e senha: " . $senha . "');</script>";
        $modeloLogin->alterarSenha($email, $senha);
      	//echo"<script>alert('tentando alterar 2');</script>";
    }
}
?>