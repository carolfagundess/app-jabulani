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

            require_once 'src/models/UsuarioModel.php';
            $model = new UsuarioModel();
            
            $admin = $model->getUsuarioByUsername($email); 

            if ($admin) {
                if (password_verify($senhaDigitada, $admin['senha'])) {
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

    public function getUsuarioById(int $id) {
        $sql = "SELECT idUsuario, nomeUsuario, email, tipoUsuario FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarUsuario(int $id, string $nome, string $email): bool {
        try {
            $sql = "UPDATE usuarios SET nomeUsuario = ?, email = ? WHERE idUsuario = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $nome, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function formEditarPerfil() {
        if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['admin_id'])) {
            header('Location: /app-jabulani/login');
            exit;
        }
        
        $id_requisicao = $_GET['id'] ?? $_SESSION['usuario_id'] ?? $_SESSION['admin_id'];

        if ($id_requisicao != ($_SESSION['usuario_id'] ?? null) && !isset($_SESSION['admin_id'])) {
            http_response_code(403);
            die("Acesso negado: Tentativa de alteração não autorizada (IDOR bloqueado).");
        }

        require_once 'src/DAO/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        $usuario = $dao->getUsuarioById($id_requisicao);
        
        require 'src/views/formEditarPerfil.php';
    }

    public static function salvarPerfil() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idUsuario'])) {
            $id_requisicao = (int) trim($_POST['idUsuario']);
            
            // 🛡️ PROTEÇÃO IDOR
            if ($id_requisicao != ($_SESSION['usuario_id'] ?? null) && !isset($_SESSION['admin_id'])) {
                http_response_code(403);
                die("Acesso negado: Tentativa de alteração não autorizada (IDOR bloqueado).");
            }

            require_once 'src/DAO/UsuarioDAO.php';
            $dao = new UsuarioDAO();
            $dao->atualizarUsuario($id_requisicao, trim($_POST['nomeUsuario']), trim($_POST['email']));
            header('Location: /app-jabulani/principal');
            exit;
        }
    }




    
}