<?php

class EventoDao
{
    private $conexao;

    public function __construct()
    {
        include 'src/config/Database/config.php';
        $conexao = Config::conexaoPDO();
        $this->conexao = $conexao;
    }

    public function getEventos()
    {
        $sql = "SELECT id, titulo, descricao, `local`, dataEvento, registroCriado FROM eventos";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEventoById(int $id)
    {
        $sql = "SELECT id, titulo, descricao, `local`, dataEvento, registroCriado FROM eventos WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function inserirEvento(string $titulo, string $descricao, string $local, string $dataEvento): bool
    {
        try {
            $sql = 'INSERT INTO eventos (titulo, descricao, `local`, dataEvento) VALUES (?, ?, ?, ?)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $titulo, PDO::PARAM_STR);
            $stmt->bindParam(2, $descricao, PDO::PARAM_STR);
            $stmt->bindParam(3, $local, PDO::PARAM_STR);
            $stmt->bindParam(4, $dataEvento, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir evento: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarEvento(int $id, string $titulo, string $descricao, string $local, string $dataEvento): bool
    {
        try {
            $sql = 'UPDATE eventos SET titulo = ?, descricao = ?, `local` = ?, dataEvento = ? WHERE id = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $titulo, PDO::PARAM_STR);
            $stmt->bindParam(2, $descricao, PDO::PARAM_STR);
            $stmt->bindParam(3, $local, PDO::PARAM_STR);
            $stmt->bindParam(4, $dataEvento, PDO::PARAM_STR);
            $stmt->bindParam(5, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar evento: " . $e->getMessage();
            return false;
        }
    }

    public function excluirEvento(int $id): bool
    {
        try {
            $sql = 'DELETE FROM eventos WHERE id = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir evento: " . $e->getMessage();
            return false;
        }
    }

    public function buscarEventos(string $termo): array {
        try {
            $sql = "SELECT id, titulo, descricao, `local`, dataEvento, registroCriado 
                    FROM eventos 
                    WHERE titulo LIKE :termo OR descricao LIKE :termo";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':termo', '%' . $termo . '%', PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

}