<?php
class AdminController{

    public static function cadastrarAdmin():void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nomeUsuario'], $_POST['email'], $_POST['senha'])) {
            $nomeUsuario = $_POST['nomeUsuario'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            if (empty($nomeUsuario) || empty($email) || empty($senha)) {
                echo "Todos os campos são obrigatórios.";
                return;
            }

            // Aqui você pode adicionar a lógica para salvar o administrador no banco de dados
            echo "Administrador cadastrado com sucesso!";
        } else {
            require_once 'src/views/admin/formCadastroAdmin.php';
        }
    }

    public static function autenticar()
    {
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


}