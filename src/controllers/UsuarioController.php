<?php

<<<<<<< HEAD
class UsuarioController
=======
class AdminController
>>>>>>> 40d1d1b146795198e080c14469ec2546fef4862d
{

    public static function formLogin()
    {
        $acao = 'autenticacao';

        require_once 'src/views/admin/formLogin.php';
    }

    public static function autenticar()
    {
<<<<<<< HEAD
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['senha'])) {
            $email = $_POST['email'];
            $senhaDigitada = $_POST['senha'];

            require_once 'src/models/UsuarioModel.php';
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

    
=======
        echo "Autenticando usuário...";
    }

>>>>>>> 40d1d1b146795198e080c14469ec2546fef4862d
}