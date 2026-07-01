<?php

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

require_once 'src/controller/UsuarioController.php';
require_once 'src/controller/BasicoController.php';
require_once 'src/controller/EventoController.php';
require_once 'src/controller/AdminController.php';

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
    case $aux.'logout':  
        UsuarioController::logout();
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
        case $aux.'meusEventos':
        EventosController::meusEventos();
        break;
    case $aux.'excluirUsuario':
        UsuarioController::excluirUsuario();
        break;
    case $aux.'api/eventos':
        EventosController::listarEventosAPI();
        break;
    case $aux.'api/usuarios':
        UsuarioController::listarUsuariosAPI();
        break;
    case $aux.'inscrever':
        EventosController::inscrever();
        break;
    default:
        echo "Página não encontrada!";
        break;
}

echo "</pre>";

?>