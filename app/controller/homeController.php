
<?php
require_once __DIR__ . '/../model/postagemModel.php';

Class homeController{

    public function index(){
        require_once __DIR__ . "/../view/Home.php";
    }

    public function login(){
        include __DIR__ . "/../view/Login.php";
    }

    public function noticias(){
        $postagemModel = new postagemModel();

        $postagem = $postagemModel->getPostagem();

        require_once __DIR__ . "/../view/Noticia.php?id=";
    }


    public function admin(){
        require_once __DIR__ . "/../view/Admin.php";
    }

    public function cadastroUser() {
        require_once __DIR__ . "/../view/cadastro.php";
    }

    public function notice() {
        require_once __DIR__ . "/../view/Noticia.php";
    }

}
