<?php

class EventoModel
{
    public function getEventos()
    {
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->getEventos();
    }
    
    public function inserirEvento(string $titulo, string $descricao, string $local, string $dataEvento, ?string $banner = null): bool
    {
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->inserirEvento($titulo, $descricao, $local, $dataEvento, $banner);
    }

    public function alterarEvento(int $id, string $titulo, string $descricao, string $local, string $dataEvento): bool
    {
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->atualizarEvento($id, $titulo, $descricao, $local, $dataEvento);
    }

    public function deletarEvento(int $id): bool
    {
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->excluirEvento($id);
    }

    public function getEventoById(int $id)
    {
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->getEventoById($id);
    }

    public static function listarEventosAPI()
    {
        require_once 'src/DAO/EventoDao.php'; // Ajuste o caminho se necessário
        $eventoDao = new EventoDao();
        $eventos = $eventoDao->getEventos();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($eventos);
        exit;
    }

}