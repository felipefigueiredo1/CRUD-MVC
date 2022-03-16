<?php

//Incluindo arquivos para iniciar rota
include('vendor/autoload.php');

use crud\controller\ControllerRoutes;

//Verificando se foi inserido algo na URL
$url = (isset($_GET['page'])) ? $_GET['page'] : null;
$pageUrl = explode('/', $url);

for($i = 0; $i < count($pageUrl); $i++){
    if (empty($pageUrl[$i]) && $i == 0){
        $page = "/";
    }
    if (!empty($pageUrl[$i]) && $i == 0){
        $page = $pageUrl[$i];
    }
}

//Chama classe com função estática que contem as rotas
$routes = ControllerRoutes::routes();

//Verificando se oque foi digitado na URL é uma rota existente no ControllerRotas
if(!array_key_exists($page, $routes)){
    header('Location: error-404');
    exit(); 
}

//Pega a rota retornada para a variavel page
$route = $routes[$page];
$controller = new $route;
$controller->processRequest();