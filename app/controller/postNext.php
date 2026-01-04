<?php
require_once __DIR__ . "/../../app/model/postagemModel.php";
 
error_reporting(0);
class NextPost {
    private $dadosBd;
 
    public function __construct(){
        $consulta = new postagemModel();
        $this->dadosBd = $consulta->consulta();
    }
 
    public function atualizar(){
        $host = "http://" . $_SERVER['HTTP_HOST'];
        $parentDir = dirname(__DIR__, 2);
        $nomeRaiz = basename($parentDir);
        //$caminho = $host . "/" . $nomeRaiz;
 		
      	// nome raiz estava pegando o msm valor de host, com isso preferi retira-lo
        $baseUrlImgs = $host . "/" . $nomeRaiz . "/app/docs/imgs/";
        $baseUrlTxt  = $host . "/" . $nomeRaiz . "/app/docs/arquivos/";
 
        $dadosParaJson = [];
 
        if (!empty($this->dadosBd)) {
            foreach ($this->dadosBd as $dados) {
                $item = [
                    'id_noticia' => $dados['id_noticia'],
                    'id_versao' => $dados['id_versao'],
                    'titulo' => $dados['titulo'],
                    'txt_url' => isset($dados['txt_url']) ? $baseUrlTxt . basename($dados['txt_url']) : '',
                    'autor' => $dados['autor'],
                    'criado_em' => $dados['criado_em'],
                    'imagens' => [],
                    'caminho' => $host,
                  	'publicado' => $dados['publicado']
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
 
        // header("Content-Type: application/json; charset=utf-8");
        // header("Access-Control-Allow-Origin: *");
        $jsonPath = __DIR__ . '../../../data.json';
        file_put_contents($jsonPath, json_encode($dadosParaJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
 
    public function chamarNext(){
        header("Location: http://localhost:3000/TelaNoticias");
        exit;
    }
}
 
if (isset($_GET["action"])) {
    $action = $_GET['action'];
    $NextPost = new NextPost();
 
    switch ($action) {
        case 'chamar':
            $NextPost->chamarNext();
            break;
        default:
            break;
    }
}
