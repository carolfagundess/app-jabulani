<?php

class UsuarioEventoDAO {
    private $conexao;

    public function __construct() {
        include_once 'src/config/Database/config.php';
        $this->conexao = Config::conexaoPDO();
    }

    public function inscrever(int $idUsuario, int $idEvento): bool {
        try {
            // Evita dupla inscrição no mesmo evento
            $verifica = "SELECT id FROM usuarioseventos WHERE idUsuario = ? AND idEvento = ?";
            $stmtVerifica = $this->conexao->prepare($verifica);
            $stmtVerifica->bindParam(1, $idUsuario, PDO::PARAM_INT);
            $stmtVerifica->bindParam(2, $idEvento, PDO::PARAM_INT);
            $stmtVerifica->execute();
            if($stmtVerifica->rowCount() > 0) return false;

            $sql = 'INSERT INTO usuarioseventos (idUsuario, idEvento) VALUES (?, ?)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(2, $idEvento, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao inscrever: " . $e->getMessage();
            return false;
        }
    }

    public function getEventosByUsuario(int $idUsuario) {
        $sql = "SELECT e.* FROM eventos e 
                INNER JOIN usuarioseventos ue ON e.id = ue.idEvento 
                WHERE ue.idUsuario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
