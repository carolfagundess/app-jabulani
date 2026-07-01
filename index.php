<?php

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

require_once 'src/controller/UsuarioController.php';
require_once 'src/controller/BasicoController.php';
require_once 'src/controller/EventoController.php';
require_once 'src/controller/AdminController.php';

$requisicao = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$aux = '/app-jabulani';

switch ($requisicao) {
    case $aux:
    case $aux.'/':
        header('Location: /app-jabulani/login');
        exit;
    case $aux.'/login':
        UsuarioController::formLogin();
        break;
    case $aux.'/autenticar':
        UsuarioController::autenticar();
        break;
    case $aux.'/logout':
        UsuarioController::logout();
        break;
    case $aux.'/cadastro':
        UsuarioController::formCadastro();
        break;
    case $aux.'/salvarUsuario':
        UsuarioController::salvarUsuario();
        break;
    case $aux.'/perfil':
        UsuarioController::formEditarPerfil();
        break;
    case $aux.'/salvarPerfil':
        UsuarioController::salvarPerfil();
        break;
    case $aux.'/principal':
        BasicoController::principal();
        break;
    case $aux.'/listarEventos':
        EventosController::listarEventos();
        break;
    case $aux.'/formInserirEvento':
        EventosController::formInserirEvento();
        break;
    case $aux.'/inserirEvento':
        EventosController::inserirEvento();
        break;
    case $aux.'/alterarEvento':
        EventosController::alterarEvento();
        break;
    case $aux.'/atualizarEvento':
        EventosController::salvarEvento();
        break;
    case $aux.'/excluirEvento':
        EventosController::excluirEvento();
        break;
    case $aux.'/meusEventos':
        EventosController::meusEventos();
        break;
    case $aux.'/excluirUsuario':
        UsuarioController::excluirUsuario();
        break;
    case $aux.'/api/eventos/lista':
        EventosController::listarEventosAPI();
        break;
    case $aux.'/api/usuarios/lista':
        UsuarioController::listarUsuariosAPI();
        break;
    case $aux.'/inscrever':
        EventosController::inscrever();
        break;
    case $aux.'/buscar':
        EventosController::buscar();
        break;
    case $aux.'/detalhesEvento':
        EventosController::detalhesEvento();
        break;
    case $aux.'/exportarEventoXml':
        EventosController::exportarEventoXml();
        break;
    case $aux.'/exportarEventoPdf':
        EventosController::exportarEventoPdf();
        break;
    default:
        header('Location: /app-jabulani/login');
        exit;
}
?>
