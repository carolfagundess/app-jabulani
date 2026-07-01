<?php
<<<<<<< HEAD
session_start(); 

require_once 'src/controllers/UsuarioController.php';
require_once 'src/controllers/BasicoController.php';
require_once 'src/controllers/EventoController.php';
=======

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
>>>>>>> ccac9c18fec9b9ce00c6db49189a2420f096f412

echo "<pre>";

$requisicao = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
echo $requisicao;

<<<<<<< HEAD
$aux = '/app-jabulani/';
switch ($requisicao) {
    case $aux . 'login':
        UsuarioController::formLogin();
        break;
    case $aux . 'autenticar':
        UsuarioController::autenticar();
        break;
    case $aux . 'cadastro':
        UsuarioController::formCadastro();
        break;
    case $aux . 'salvarUsuario':
        UsuarioController::salvarUsuario();
        break;
    case $aux . 'principal':
=======
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
>>>>>>> ccac9c18fec9b9ce00c6db49189a2420f096f412
        BasicoController::principal();
        break;
    case $aux . 'listarEventos':
        EventosController::listarEventos();
        break;
    case $aux . 'formInserirEvento':
        EventosController::formInserirEvento();
        break;
    case $aux . 'inserirEvento':
        EventosController::inserirEvento();
        break;
<<<<<<< HEAD
    case $aux . 'inscreverEvento':
        EventosController::inscreverEvento();
        break;
    case $aux . 'meusEventos':
        EventosController::meusEventos();
        break;
    case $aux . 'editarPerfil':
        UsuarioController::formEditarPerfil();
        break;
    case $aux . 'salvarPerfil':
        UsuarioController::salvarPerfil();
        break;
    case $aux . 'alterarEvento':
        EventosController::alterarEvento();
        break;
    case $aux . 'atualizarEvento':
        EventosController::salvarEvento();
        break;
    case $aux . 'excluirEvento':
        EventosController::excluirEvento();
        break;
    case '/api/eventos/lista':
        EventosController::listarEventosAPI();
        break;
    case '/api/usuarios/lista':
        UsuarioController::listarUsuariosAPI();
        break;
    case $aux . 'excluirUsuario':
        UsuarioController::excluirUsuario();
        break;
=======
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
>>>>>>> ccac9c18fec9b9ce00c6db49189a2420f096f412
    default:
        echo "Página não encontrada!";
        break;
}
echo "</pre>";
?>