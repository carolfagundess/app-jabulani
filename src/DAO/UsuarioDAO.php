<?php

class UsuarioDAO
{
    private $conexao;

    public function __construct()
    {
        include 'src/config/Database/config.php';
        $conexao = Config::conexaoPDO();
        $this->conexao = $conexao;
        $this->ensureTelefoneColumn();
        $this->ensureTipoUsuarioColumn();
    }

    private function ensureTelefoneColumn(): void
    {
        try {
            $this->conexao->query('SELECT telefone FROM usuarios LIMIT 1');
        } catch (PDOException $e) {
            $this->conexao->exec('ALTER TABLE usuarios ADD COLUMN telefone VARCHAR(20) DEFAULT NULL');
        }
    }

    private function ensureTipoUsuarioColumn(): void
    {
        try {
            $this->conexao->query('SELECT tipoUsuario FROM usuarios LIMIT 1');
        } catch (PDOException $e) {
            $this->conexao->exec("ALTER TABLE usuarios ADD COLUMN tipoUsuario ENUM('admin','participante') NOT NULL DEFAULT 'participante'");
        }
    }

    public function getUsuarios()
    {
        $this->ensureTipoUsuarioColumn();
        $sql = "SELECT idUsuario, nomeUsuario, email, tipoUsuario FROM usuarios";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioByUsername(string $username)
    {
        try {
            $this->ensureTipoUsuarioColumn();
            $sql = "SELECT idUsuario, nomeUsuario, email, senha, tipoUsuario FROM usuarios WHERE nomeUsuario = ? OR email = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $username, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario ?: null;
        } catch (PDOException $e) {
            echo "Erro ao buscar usuario: " . $e->getMessage();
            return false;
        }
    }

    public function getUsuarioById(int $id)
    {
        try {
            $this->ensureTelefoneColumn();
            $this->ensureTipoUsuarioColumn();
            $sql = "SELECT idUsuario, nomeUsuario, email, telefone, tipoUsuario FROM usuarios WHERE idUsuario = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            echo "Erro ao buscar usuário: " . $e->getMessage();
            return null;
        }
    }

    public function inserirUsuario(string $nomeUsuario, string $email, string $senha, string $tipoUsuario): bool
    {
        try {
            $this->ensureTipoUsuarioColumn();
            $sql = 'INSERT INTO usuarios (nomeUsuario, email, senha, tipoUsuario) VALUES (?, ?, ?, ?)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $nomeUsuario, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $senha, PDO::PARAM_STR);
            $stmt->bindParam(4, $tipoUsuario, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir usuario: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarUsuario(int $id, string $nomeUsuario, string $email, string $telefone = ''): bool
    {
        try {
            $this->ensureTelefoneColumn();
            if ($telefone !== '') {
                $sql = 'UPDATE usuarios SET nomeUsuario = ?, email = ?, telefone = ? WHERE idUsuario = ?';
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindParam(1, $nomeUsuario, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $telefone, PDO::PARAM_STR);
                $stmt->bindParam(4, $id, PDO::PARAM_INT);
            } else {
                $sql = 'UPDATE usuarios SET nomeUsuario = ?, email = ? WHERE idUsuario = ?';
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindParam(1, $nomeUsuario, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $id, PDO::PARAM_INT);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function excluirUsuario(int $id): bool
    {
        try {
            $sql = 'DELETE FROM usuarios WHERE idUsuario = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir usuário: " . $e->getMessage();
            return false;
        }
    }

    public function buscarUsuarios(string $termo): array
    {
        try {
            $sql = "SELECT idUsuario, nomeUsuario, email FROM usuarios WHERE nomeUsuario LIKE :termo OR email LIKE :termo";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':termo', '%' . $termo . '%', PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}