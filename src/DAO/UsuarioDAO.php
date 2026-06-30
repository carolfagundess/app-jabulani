<?php

class UsuarioDAO
{
    private $conexao;

    public function __construct()
    {
        include 'src/config/Database/config.php';
        $conexao = Config::conexaoPDO();
        $this->conexao = $conexao;
    }

    public function getUsuarios()
    {
        $sql = "SELECT idUsuario, nomeUsuario, email FROM usuarios";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioByUsername(string $username)
    {
        try {
            $sql = "SELECT idUsuario, nomeUsuario, email FROM usuarios WHERE nomeUsuario = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario ?: null;
        } catch (PDOException $e) {
            echo "Erro ao buscar usuario: " . $e->getMessage();
            return false;
        }
    }

    public function inserirUsuario(string $nomeUsuario, string $email, string $senha, string $telefone): bool
    {
        try {
            $sql = 'INSERT INTO usuarios (nomeUsuario, email, senha, telefone) VALUES (?, ?, ?, ?)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $nomeUsuario, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $senha, PDO::PARAM_STR);
            $stmt->bindParam(4, $telefone, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir usuario: " . $e->getMessage();
            return false;
        }
    }
}