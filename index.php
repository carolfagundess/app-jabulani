<?php
require_once 'src/controllers/UsuarioController.php';
require_once 'src/controllers/BasicoController.php';
require_once 'src/controllers/EventosController.php';

echo "<pre>";

//Pegar a rota da URL
$requisicao = $_SERVER['REQUEST_URI'];
echo $requisicao;

//Roteamento
$aux = '/app-jabulani/';
switch ($requisicao) {

    //Rotas para Sistema de paginas 
    case $aux.'admin/login':  
        AdminController::formLogin();
        break;
    case $aux.'admin/autenticar':  
        AdminController::autenticar();
        break;
    case $aux.'principal':  
        BasicoController::principal();
        break;
    case $aux.'listarEventos':  
        EventosController::listarEventos();
        break;
    case $aux.'formInserirEvento':
        EventosController::formInserirEvento();
        break;
    case $aux.'inserirEvento':
        EventosController::inserirEvento();
        break;
    default:
        echo "Página não encontrada!";
        break;
}

echo "</pre>";

?>