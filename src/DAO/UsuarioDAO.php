<?php

class AdminDAO{
    private $conexao;

    public function __construct()
    {
        include 'src/config/Database/config.php';
        $conexao = Config::conexaoPDO();
        $this->conexao = $conexao;
    }

    public function getAdminByUsername(string $username)
    {   
        try{
        $sql = "SELECT idUsuario, nomeUsuario, email FROM usuarios WHERE nomeUsuario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $admin ?: null;
        }catch (PDOException $e) {
            echo "Erro ao buscar admin: " . $e->getMessage();
            return false;
        }
    }
}