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

            $admin = $model->getUsuarioByUsername($email); 

            if ($admin) {
                if (password_verify($senhaDigitada, $admin['senha'])) {
                    $_SESSION['admin_id'] = $admin['idUsuario'];

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

            require_once 'src/model/UsuarioModel.php';
            $model = new UsuarioModel();

            if ($model->inserirUsuario($nomeUsuario, $email, $senhaHash)) {
                header('Location: /app-jabulani/login');
                exit;
            } else {
                echo "Erro ao cadastrar o usuário no sistema.";
            }
        } else {
            echo "Dados incompletos no formulário de cadastro.";
        }
    }
}