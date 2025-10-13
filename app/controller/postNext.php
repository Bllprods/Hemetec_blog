<?php
require_once __DIR__ . "/../../app/model/postagemModel.php"; 


class NextPost {
    public function __construct(){
    // Instancia o model e consulta os dados
        $consulta = new postagemModel();
        $this->dadosBd = $consulta->consulta();
    }
    public function atualizar(){
        // Base URLs públicas para navegador
        $baseUrlImgs = "http://localhost/a/app/docs/imgs/";
        $baseUrlTxt  = "http://localhost/a/app/docs/arquivos/";
        
        $dadosParaJson = [];
        if (!empty($this->dadosBd)) {
            foreach ($this->dadosBd as $dados) {
                $item = [
                    'id_noticia' => $dados['id_noticia'],
                    'id_versao'  => $dados['id_versao'],
                    'titulo'     => $dados['titulo'],
                    'txt_url'    => isset($dados['txt_url']) ? $baseUrlTxt . basename($dados['txt_url']) : '',
                    'autor'      => $dados['autor'],
                    'criado_em'  => $dados['criado_em'],
                    'imagens'    => [],
                ];
                if (!empty($dados['imagens'])) {
                    foreach ($dados['imagens'] as $imagem) {
                        if (!empty($imagem['img_url'])) {
                            $item['imagens'][] = $baseUrlImgs . basename($imagem['img_url']);
                        }
                    }
                }
                

                $dadosParaJson[] = $item;
            }
        }
        
        // header("Access-Control-Allow-Origin: *");
        // header('Content-Type: application/json; charset=utf-8');
        
        // return json_encode($dadosParaJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
        $jsonPath = __DIR__ . '../../../data.json';
        file_put_contents($jsonPath, json_encode($dadosParaJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    
    public function chamarNext(){
        // $tipo = $_GET['type'];
        header("Location: http://localhost:3000/TelaNoticias");
        exit;
    }
}
$action = $_GET['action'];
$NextPost = new NextPost();
switch ($action) {
    case 'chamar':
        $NextPost->chamarNext();
        break;
    case 'atualizar':
        $NextPost->atualizar();
        break;
    default:
        $NextPost->atualizar();
        break;
}