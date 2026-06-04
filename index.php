<?php


INCLUDE 'src/controllers/AdminController.php';

echo "<pre>";

//Pegar a rota da URL
$requisicao = $_SERVER['REQUEST_URI'];

//Roteamento
$aux = '/jabulani-eventos/';
switch ($requisicao) {

    //Rotas para Sistema de paginas 
    case $aux.'admin/login':  
        AdminController::formLogin();
        break;
    case $aux.'/admin/autenticar':  
        AdminController::autenticar();
        break;
    default:
        echo "Página não encontrada!";
        break;
}

echo "</pre>";

?>