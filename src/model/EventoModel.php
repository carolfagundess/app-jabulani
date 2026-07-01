<?php

class EventoModel
{
    public function getEventos()
    {
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->getEventos();
    }

    public function inserirEvento(string $titulo, string $descricao, string $local, string $dataEvento): bool
    {
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        return $dao->inserirEvento($titulo, $descricao, $local, $dataEvento);
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

    public function getParticipantesByEvento(int $idEvento): array
    {
        require_once 'src/DAO/UsuarioEventoDAO.php';
        $dao = new UsuarioEventoDAO();
        return $dao->getParticipantesByEvento($idEvento);
    }

    public static function listarEventosAPI()
    {
        require_once 'src/DAO/EventoDao.php';
        $eventoDao = new EventoDao();
        $eventos = $eventoDao->getEventos();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($eventos);
        exit;
    }
}