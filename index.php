<?php
session_start(); 

require_once 'src/controller/UsuarioController.php';
require_once 'src/controller/BasicoController.php';
require_once 'src/controller/EventoController.php';

echo "<pre>";

$requisicao = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
echo $requisicao;

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
        BasicoController::principal();
        break;
    case $aux . 'listarEventos':
        EventoController::listarEventos();
        break;
    case $aux . 'formInserirEvento':
        EventoController::formInserirEvento();
        break;
    case $aux . 'inserirEvento':
        EventoController::inserirEvento();
        break;
    case $aux . 'inscreverEvento':
        EventoController::inscreverEvento();
        break;
    case $aux . 'meusEventos':
        EventoController::meusEventos();
        break;
    case $aux . 'editarPerfil':
        UsuarioController::formEditarPerfil();
        break;
    case $aux . 'salvarPerfil':
        UsuarioController::salvarPerfil();
        break;
    case $aux . 'alterarEvento':
        EventoController::alterarEvento();
        break;
    case $aux . 'atualizarEvento':
        EventoController::salvarEvento();
        break;
    case $aux . 'excluirEvento':
        EventoController::excluirEvento();
        break;
    case '/api/eventos/lista':
        EventoController::listarEventosAPI();
        break;
    case '/api/usuarios/lista':
        UsuarioController::listarUsuariosAPI();
        break;
    case $aux . 'excluirUsuario':
        UsuarioController::excluirUsuario();
        break;
    default:
        echo "Página não encontrada!";
        break;
}
echo "</pre>";
?>