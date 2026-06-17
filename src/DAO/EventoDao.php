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
    public function getEventosById(int $id)
    {
        $sql = "SELECT id, titulo, descricao, `local`, dataEvento, registroCriado FROM eventos WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);   
        }


    public function inserirEvento(string $titulo, string $descricao, string $local, string $dataEvento):bool{
        try{
            $sql = 'INSERT INTO eventos (titulo, descricao, `local`, dataEvento) VALUES (?, ?, ?, ?)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $titulo, PDO::PARAM_STR);
            $stmt->bindParam(2, $descricao, PDO::PARAM_STR);
            $stmt->bindParam(3, $local, PDO::PARAM_STR);
            $stmt->bindParam(4, $dataEvento, PDO::PARAM_STR);
            return $stmt->execute();
        }catch (PDOException $e) {
        echo "Erro ao inserir evento: " . $e->getMessage();
        return false;
        }
    }

    public function getEventoById(int $id):string{
        try{
            $sql = 'SELECT nome FROM marcas WHERE id_marca = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['nome'] : '';
        }
    }
    
    
}