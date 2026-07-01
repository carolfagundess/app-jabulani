<?php

class EventosController
{
    private static function verificarAdmin(): void
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /app-jabulani/login');
            exit;
        }
    }
    public static function listarEventos(): void
    {
        require_once 'src/model/EventoModel.php';

        $model = new EventoModel();
        $listaEventos = $model->getEventos();

        require 'src/views/eventoView.php';
    }

    public static function formInserirEvento(): void
    {
        self::verificarAdmin();
        $acao = 'inserirEvento';
        require 'src/views/formInserirEvento.php';
    }

    public static function inserirEvento(): void
    {
        self::verificarAdmin();
        if (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['titulo']) &&
            isset($_POST['descricao']) &&
            isset($_POST['local']) &&
            isset($_POST['dataEvento'])
        ) {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $local = $_POST['local'];
            $dataEvento = $_POST['dataEvento'];

            require 'src/model/EventoModel.php';
            $model = new EventoModel();

            $retornoInserir = $model->inserirEvento($titulo, $descricao, $local, $dataEvento);

            header('Location: /app-jabulani/listarEventos'); // chamada pra pagina de listar eventos
            exit; // É recomendado colocar exit após um header de redirecionamento

        } else {
            echo "Mensagem de erro: Faltam dados no formulário ou método incorreto.";
        }
    }

    public static function alterarEvento(): void
    {
        self::verificarAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'] )) {
            $auxId = (int) trim($_POST['id']);
            $auxTitulo = trim($_POST['titulo']);

            require_once 'src/model/EventoModel.php';

            $eventos = new EventoModel();
            $retorno = $eventos->getEventoById($auxId);

            if ($retorno) {
                $acao = 'atualizarEvento';
                $titulo = $retorno['titulo'];
                $descricao = $retorno['descricao'];
                $local = $retorno['local'];
                $dataEvento = $retorno['dataEvento'];
                require 'src/views/formInserirEvento.php';
            } else {
                echo "Evento não encontrado.";
            }
        }
    }

    public static function salvarEvento(): void
    {
        self::verificarAdmin();
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['id']) &&
            isset($_POST['titulo']) &&
            isset($_POST['descricao']) &&
            isset($_POST['local']) &&
            isset($_POST['dataEvento'])
        ) {
            $id = (int) trim($_POST['id']);
            $titulo = trim($_POST['titulo']);
            $descricao = trim($_POST['descricao']);
            $local = trim($_POST['local']);
            $dataEvento = trim($_POST['dataEvento']);

            require_once 'src/model/EventoModel.php';
            $eventos = new EventoModel();
            $retornoAtualizar = $eventos->alterarEvento($id, $titulo, $descricao, $local, $dataEvento);

            header('Location: /app-jabulani/listarEventos');
            exit;
        } else {
            echo "Mensagem de erro: Faltam dados no formulário ou método incorreto.";
        }
    }

    public static function excluirEvento(): void
    {
        self::verificarAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int) trim($_POST['id']);

            require_once 'src/model/EventoModel.php';
            $eventos = new EventoModel();
            $retornoExcluir = $eventos->deletarEvento($id);

            header('Location: /app-jabulani/listarEventos');
            exit;
        } else {
            echo "Mensagem de erro: Faltam dados no formulário ou método incorreto.";
        }
    }
}