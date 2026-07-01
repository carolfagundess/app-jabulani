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

            $model->inserirEvento($titulo, $descricao, $local, $dataEvento);

            header('Location: /app-jabulani/listarEventos');
            exit;
        } else {
            echo "Mensagem de erro: Faltam dados no formulário ou método incorreto.";
        }
    }

    public static function alterarEvento(): void
    {
        self::verificarAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $auxId = (int) trim($_POST['id']);

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
            $eventos->alterarEvento($id, $titulo, $descricao, $local, $dataEvento);

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
            $eventos->deletarEvento($id);

            header('Location: /app-jabulani/listarEventos');
            exit;
        } else {
            echo "Mensagem de erro: Faltam dados no formulário ou método incorreto.";
        }
    }

    public static function meusEventos(): void
    {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /app-jabulani/login');
            exit;
        }
        require_once 'src/DAO/UsuarioEventoDAO.php';
        $dao = new UsuarioEventoDAO();
        $listaEventos = $dao->getEventosByUsuario($_SESSION['usuario_id']);

        require 'src/views/meusEventosView.php';
    }

    public static function listarEventosAPI()
    {
        require_once 'src/DAO/EventoDao.php';
        $eventoDao = new EventoDao();
        $eventos = $eventoDao->getEventos();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function inscrever(): void
    {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /app-jabulani/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idEvento'])) {
            $idEvento = (int) trim($_POST['idEvento']);
            $idUsuario = $_SESSION['usuario_id'];

            require_once 'src/DAO/UsuarioEventoDAO.php';
            $dao = new UsuarioEventoDAO();
            $dao->inscrever($idUsuario, $idEvento);

            header('Location: /app-jabulani/meusEventos');
            exit;
        }
    }

    public static function buscar(): void
    {
        $termo = isset($_GET['q']) ? trim($_GET['q']) : '';
        require_once 'src/DAO/EventoDao.php';
        $dao = new EventoDao();
        $listaEventos = $dao->buscarEventos($termo);

        require 'src/views/eventoView.php';
    }

    public static function detalhesEvento(): void
    {
        self::verificarAdmin();

        $idEvento = isset($_GET['id']) ? (int) trim($_GET['id']) : 0;
        if ($idEvento <= 0) {
            header('Location: /app-jabulani/listarEventos');
            exit;
        }

        require_once 'src/model/EventoModel.php';
        $model = new EventoModel();
        $evento = $model->getEventoById($idEvento);

        if (!$evento) {
            echo 'Evento não encontrado.';
            return;
        }

        $participantes = $model->getParticipantesByEvento($idEvento);
        require 'src/views/detalhesEventoView.php';
    }

    public static function exportarEventoXml(): void
    {
        self::verificarAdmin();

        $idEvento = isset($_GET['id']) ? (int) trim($_GET['id']) : 0;
        if ($idEvento <= 0) {
            header('Location: /app-jabulani/listarEventos');
            exit;
        }

        require_once 'src/model/EventoModel.php';
        $model = new EventoModel();
        $evento = $model->getEventoById($idEvento);
        $participantes = $model->getParticipantesByEvento($idEvento);

        if (!$evento) {
            echo 'Evento não encontrado.';
            return;
        }

        $xml = new SimpleXMLElement('<evento/>');
        $xml->addChild('id', $evento['id']);
        $xml->addChild('titulo', $evento['titulo']);
        $xml->addChild('descricao', $evento['descricao']);
        $xml->addChild('local', $evento['local']);
        $xml->addChild('dataEvento', $evento['dataEvento']);

        $participantesNode = $xml->addChild('participantes');
        foreach ($participantes as $participante) {
            $participanteNode = $participantesNode->addChild('participante');
            $participanteNode->addChild('nome', $participante['nomeUsuario']);
            $participanteNode->addChild('email', $participante['email']);
        }

        header('Content-Type: application/xml; charset=utf-8');
        header('Content-Disposition: attachment; filename="evento-' . $idEvento . '.xml"');
        echo $xml->asXML();
        exit;
    }

    public static function exportarEventoPdf(): void
    {
        self::verificarAdmin();

        $idEvento = isset($_GET['id']) ? (int) trim($_GET['id']) : 0;
        if ($idEvento <= 0) {
            header('Location: /app-jabulani/listarEventos');
            exit;
        }

        require_once 'src/model/EventoModel.php';
        $model = new EventoModel();
        $evento = $model->getEventoById($idEvento);
        $participantes = $model->getParticipantesByEvento($idEvento);

        if (!$evento) {
            echo 'Evento não encontrado.';
            return;
        }

        $linhas = [
            'Relatório do Evento',
            '',
            'Título: ' . $evento['titulo'],
            'Descrição: ' . $evento['descricao'],
            'Local: ' . $evento['local'],
            'Data: ' . $evento['dataEvento'],
            '',
            'Participantes (' . count($participantes) . '):'
        ];

        foreach ($participantes as $participante) {
            $linhas[] = '- ' . $participante['nomeUsuario'] . ' <' . $participante['email'] . '>';
        }

        $pdf = self::gerarPdfSimples($linhas);

        if (ob_get_length()) {
            ob_clean();
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="evento-' . $idEvento . '.pdf"');
        header('Content-Length: ' . strlen($pdf));
        echo $pdf;
        exit;
    }

    private static function gerarPdfSimples(array $linhas): string
    {
        $content = '';
        $y = 760;

        foreach ($linhas as $linha) {
            $texto = self::textoPdfLiteral($linha);
            $content .= "BT /F1 12 Tf 50 $y Td ($texto) Tj ET\n";
            $y -= 14;
        }

        $objects = [];
        $objects[] = "<< /Type /Catalog /Pages 2 0 R >>";
        $objects[] = "<< /Type /Pages /Kids [3 0 R] /Count 1 >>";
        $objects[] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>";
        $length = strlen($content);
        $objects[] = "<< /Length $length >>\nstream\n$content\nendstream";
        $objects[] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>";

        $pdf = "%PDF-1.4\n";
        $offsets = [];
        $offsets[0] = 0;

        foreach ($objects as $index => $object) {
            $offsets[$index + 1] = strlen($pdf);
            $pdf .= ($index + 1) . " 0 obj\n" . $object . "\nendobj\n";
        }

        $startXref = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";
        foreach ($objects as $index => $_) {
            $pdf .= str_pad($offsets[$index + 1], 10, '0', STR_PAD_LEFT) . " 00000 n \n";
        }

        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n$startXref\n%%EOF";

        return $pdf;
    }

    private static function textoPdfLiteral(string $texto): string
    {
        $winAnsi = mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');
        $escaped = str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $winAnsi);
        return $escaped;
    }
}