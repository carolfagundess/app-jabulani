<?php

class UsuarioController
{

    public static function formLogin()
    {
        $acao = 'autenticacao';

        require_once 'src/views/admin/formLogin.php';
    }

    public static function autenticar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['senha'])) {
            $email = $_POST['email'];
            $senhaDigitada = $_POST['senha'];

            require_once 'src/model/UsuarioModel.php';
            $model = new UsuarioModel();

            // 1. Busca os dados do administrador no banco usando o e-mail ou nome de usuário
            $admin = $model->getUsuarioByUsername($email); // Ajuste o método conforme seu Model

            if ($admin) {
                // 2. Compara a senha digitada com o hash guardado na coluna 'senha' do banco
                if (password_verify($senhaDigitada, $admin['senha'])) {
                    // Senha correta! Inicia a sessão do usuário
                    session_start();
                    $_SESSION['admin_id'] = $admin['idUsuario'];

                    header('Location: /app-jabulani/listarEventos');
                    exit;
                } else {
                    echo "Senha incorreta!";
                }
            } else {
                echo "Usuário não encontrado!";
            }
        }
    }

    public static function formCadastro()
    {
        $acao = 'salvarUsuario';
        require_once 'src/views/admin/formCadastro.php';
    }

    // ADICIONE ESTE MÉTODO: Recebe os dados via POST e envia para o Model
    public static function salvarUsuario()
    {
        if (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['nomeUsuario']) &&
            isset($_POST['email']) &&
            isset($_POST['senha']) &&
            isset($_POST['telefone'])
        ) {
            $nomeUsuario = trim($_POST['nomeUsuario']);
            $email = trim($_POST['email']);
            $senha = $_POST['senha']; // Ajustar hash
            $telefone = trim($_POST['telefone']);

            require_once 'src/model/UsuarioModel.php';
            $model = new UsuarioModel();

            if ($model->inserirUsuario($nomeUsuario, $email, $senha, $telefone)) {
                // Redireciona para a tela de login após cadastrar com sucesso
                header('Location: /app-jabulani/login');
                exit;
            } else {
                echo "Erro ao cadastrar o usuário no sistema.";
            }
        } else {
            echo "Dados incompletos no formulário de cadastro.";
        }
    }

    public static function listarUsuariosAPI()
    {
        require_once 'src/DAO/UsuarioDAO.php'; // Ajuste o caminho se necessário
        $usuarioDao = new UsuarioDAO();
        $usuarios = $usuarioDao->getUsuarios();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($usuarios);
        exit;
    }

    public static function excluirUsuario()
    {
        // Proteção: Apenas admin pode excluir
        if (!isset($_SESSION['admin_id'])) {
            die("Acesso negado.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idUsuario'])) {
            $id = (int) trim($_POST['idUsuario']);

            require_once 'src/model/UsuarioModel.php';
            $model = new UsuarioModel();

            if ($model->deletarUsuario($id)) {
                // Redireciona de volta para a lista de usuários (ou página principal)
                header('Location: /app-jabulani/principal');
                exit;
            } else {
                echo "Erro ao excluir participante.";
            }
        }
    }
}