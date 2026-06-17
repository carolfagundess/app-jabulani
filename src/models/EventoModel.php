<?php

class EventoModel{
    public function getEventos()
    {
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->getEventos();
    }
    public function inserirEvento(string $titulo, string $descricao, string $local, string $dataEvento):bool
    {
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->inserirEvento($titulo, $descricao, $local, $dataEvento);
    }

    public function alterarEvento(int $id, string $nome):bool{
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->alterarEvento($id, $nome);
    }

    public function deletarEvento(int $id):bool{
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->deletarEvento($id);
    }

}