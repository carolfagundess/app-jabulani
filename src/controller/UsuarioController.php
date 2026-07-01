<?php

class UsuarioController
{

    public static function formLogin()
    {
        $acao = 'autenticar';

        require_once 'src/views/formLogin.php';
    }

    public static function autenticar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['senha'])) {
            $email = $_POST['email'];
            $senhaDigitada = $_POST['senha'];

            require_once 'src/model/UsuarioModel.php';
            $model = new UsuarioModel();

            $usuario = $model->getUsuarioByUsername($email);
            if ($usuario) {
                if (password_verify($senhaDigitada, $usuario['senha'])) {
                    unset($_SESSION['admin_id'], $_SESSION['usuario_id']);

                    if ($usuario['tipoUsuario'] === 'admin') {
                        $_SESSION['admin_id'] = $usuario['idUsuario'];
                    } else {
                        $_SESSION['usuario_id'] = $usuario['idUsuario'];
                    }
                    header('Location: /app-jabulani/listarEventos');
                    exit;
                } else {
                    echo "<br><br>Senha incorreta!
                    <br><a href='/app-jabulani/login'>Voltar para o login</a>";
                }
            } else {
                echo "<br><br>Usuário não encontrado!
                <br><a href='/app-jabulani/login'>Voltar para o login</a>";
            }
        }
    }

    public static function logout()
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
        header('Location: /app-jabulani/login');
        exit;
    }

    public static function formCadastro()
    {
        $acao = 'salvarUsuario';
        require_once 'src/views/admin/formCadastro.php';
    }

    public static function salvarUsuario()
    {
        if (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['nomeUsuario']) &&
            isset($_POST['email']) &&
            isset($_POST['senha']) &&
            isset($_POST['confirmarSenha'])
        ) {
            $nomeUsuario = trim($_POST['nomeUsuario']);
            $email = trim($_POST['email']);
            $senha = $_POST['senha'];
            $confirmarSenha = $_POST['confirmarSenha'];

            if ($senha !== $confirmarSenha) {
                echo "Erro: As senhas não coincidem.";
                return;
            }

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $tipoUsuario = 'participante';

            require_once 'src/model/UsuarioModel.php';
            $model = new UsuarioModel();

            if ($model->inserirUsuario($nomeUsuario, $email, $senhaHash, $tipoUsuario)) {
                header('Location: /app-jabulani/login');
                exit;
            } else {
                echo "Erro ao cadastrar o usuário no sistema.";
            }
        } else {
            echo "Dados incompletos no formulário de cadastro.";
        }
    }

    public static function formEditarPerfil(): void
    {
        if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['admin_id'])) {
            header('Location: /app-jabulani/login');
            exit;
        }

        $idUsuario = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : $_SESSION['admin_id'];
        require_once 'src/model/UsuarioModel.php';
        $model = new UsuarioModel();
        $usuario = $model->getUsuarioById($idUsuario);

        require_once 'src/views/formEditarPerfil.php';
    }

    public static function salvarPerfil(): void
    {
        if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['admin_id'])) {
            header('Location: /app-jabulani/login');
            exit;
        }

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['nomeUsuario']) &&
            isset($_POST['email'])
        ) {
            $idUsuario = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : $_SESSION['admin_id'];
            $nomeUsuario = trim($_POST['nomeUsuario']);
            $email = trim($_POST['email']);
            $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';

            require_once 'src/model/UsuarioModel.php';
            $model = new UsuarioModel();

            if ($model->atualizarUsuario($idUsuario, $nomeUsuario, $email, $telefone)) {
                $_SESSION['mensagem_sucesso'] = 'Perfil atualizado com sucesso.';
                header('Location: /app-jabulani/perfil');
                exit;
            }

            echo 'Não foi possível salvar as alterações do perfil.';
            return;
        }

        echo 'Dados incompletos para atualizar o perfil.';
    }

    public static function listarUsuariosAPI()
    {
        require_once 'src/DAO/UsuarioDAO.php';
        $usuarioDao = new UsuarioDAO();
        $usuarios = $usuarioDao->getUsuarios();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($usuarios, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function excluirUsuario()
    {
        if (!isset($_SESSION['admin_id'])) {
            die("Acesso negado.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idUsuario'])) {
            $id = (int) trim($_POST['idUsuario']);

            require_once 'src/model/UsuarioModel.php';
            $model = new UsuarioModel();

            if ($model->deletarUsuario($id)) {
                header('Location: /app-jabulani/principal');
                exit;
            } else {
                echo "Erro ao excluir participante.";
            }
        }
    }
}