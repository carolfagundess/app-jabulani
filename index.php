<?php
require_once 'src/controller/UsuarioController.php';
require_once 'src/controller/BasicoController.php';
require_once 'src/controller/EventoController.php';

echo "<pre>";

//Pegar a rota da URL
$requisicao = $_SERVER['REQUEST_URI'];
echo $requisicao;

// Roteamento
$aux = '/app-jabulani/';
switch ($requisicao) {

    // Rotas de Usuário 
    case $aux.'login':  
        UsuarioController::formLogin();
        break;
    case $aux.'autenticar':  
        UsuarioController::autenticar();
        break;
    case $aux.'cadastro':  
        UsuarioController::formCadastro();
        break;
    case $aux.'salvarUsuario':  
        UsuarioController::salvarUsuario();
        break;

    // Rotas de Sistema e Eventos
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
    case $aux.'alterarEvento':
        EventosController::alterarEvento();
        break;
    case $aux.'atualizarEvento':
        EventosController::salvarEvento();
        break;
    case $aux.'excluirEvento':
        EventosController::excluirEvento();
        break;
    default:
        echo "Página não encontrada!";
        break;
}

echo "</pre>";

?>