<?php

//Incluindo arquivos para iniciar rota
include('vendor/autoload.php');

use crud\controller\ControllerRotas;

//Verificando se foi inserido algo na URL
$url = (isset($_GET['pagina'])) ? $_GET['pagina'] : null;
$paginaUrl = explode('/', $url);

for($i = 0; $i < count($paginaUrl); $i++){
    if (empty($paginaUrl[$i]) && $i == 0){
        $pagina = "/";
    }
    if (!empty($paginaUrl[$i]) && $i == 0){
        $pagina = $paginaUrl[$i];
    }
}

$rotas = ControllerRotas::rotas();

//Verificando se oque foi digitado na URL é uma rota existente no ControllerRotas
if(!array_key_exists($pagina, $rotas)){
    header('Location: error-404');
    exit(); 
}

//Por fim, pegando a rota e processando
$rota = $rotas[$pagina];
$controllador = new $rota;
$controllador->processaRequisicao();