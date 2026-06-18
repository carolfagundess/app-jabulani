<?php

class UsuarioDAO{
    private $conexao;

    public function __construct()
    {
        include 'src/config/Database/config.php';
        $conexao = Config::conexaoPDO();
        $this->conexao = $conexao;
    }

    public function getUsuarioByUsername(string $username)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['senha']) && isset($_POST['nomeUsuario']) && isset($_POST['email'])){
            $nomeUsuario = $_POST['nomeUsuario'];
            $email = $_POST['email'];
            $senhaPura = $_POST['senha'];

            $senhaHash = password_hash($senhaPura, PASSWORD_DEFAULT);

            require_once 'src/DAO/UsuarioDAO.php';
            $model = new UsuarioDAO();

            $resultado = $model->inserirUsuario($nomeUsuario, $email, $senhaHash);

            if ($resultado) {
            header('Location: /app-jabulani/usuario/login');
            exit;
            }
        }
    }
}