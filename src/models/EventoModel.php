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

}