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
        EventoController::listarEventos();
        break;
    case $aux.'/formInserirEvento':
        EventoController::formInserirEvento();
        break;
    case $aux.'/inserirEvento':
        EventoController::inserirEvento();
        break;
    case $aux.'/alterarEvento':
        EventoController::alterarEvento();
        break;
    case $aux.'/atualizarEvento':
        EventoController::salvarEvento();
        break;
    case $aux.'/excluirEvento':
        EventoController::excluirEvento();
        break;
    case $aux.'/meusEventos':
        EventoController::meusEventos();
        break;
    case $aux.'/excluirUsuario':
        UsuarioController::excluirUsuario();
        break;
    case $aux.'/api/eventos/lista':
        EventoController::listarEventosAPI();
        break;
    case $aux.'/api/usuarios/lista':
        UsuarioController::listarUsuariosAPI();
        break;
    case $aux.'/inscrever':
        EventoController::inscrever();
        break;
    case $aux.'/buscar':
        EventoController::buscar();
        break;
    case $aux.'/detalhesEvento':
        EventoController::detalhesEvento();
        break;
    case $aux.'/removerParticipante':
        EventoController::removerParticipante();
        break;
    case $aux.'/exportarEventoXml':
        EventoController::exportarEventoXml();
        break;
    case $aux.'/exportarEventoPdf':
        EventoController::exportarEventoPdf();
        break;
    case $aux.'/erro':
        BasicoController::erro();
        break;
    default:
        header('Location: /app-jabulani/erro');
        exit;
}
?>
