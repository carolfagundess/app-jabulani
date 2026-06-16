<?php

class EventosController{
    public static function listarEventos():void
    {
        require_once 'src/models/EventoModel.php';

        $model = new EventoModel();
        $listaEventos = $model->getEventos();

        require 'src/views/eventoView.php';
    }

    public static function formInserirEvento():void
    {
        $acao = 'inserirEvento';
        require 'src/views/formInserirEvento.php';
    }

    public static function inserirEvento():void{
            if (
            $_SERVER['REQUEST_METHOD'] == 'POST' && 
            isset($_POST['titulo']) && 
            isset($_POST['descricao']) && 
            isset($_POST['local']) && 
            isset($_POST['dataEvento'])
        ) {
            // 2. Captura os 4 dados
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $local = $_POST['local'];
            $dataEvento = $_POST['dataEvento'];
            
            require 'src/models/EventoModel.php';
            $model = new EventoModel();
            
            // 3. Envia os 4 dados para o Model, na ordem certa
            $retornoInserir = $model->inserirEvento($titulo, $descricao, $local, $dataEvento);

            header('Location: /app-jabulani/listarEventos'); // chamada pra pagina de listar eventos
            exit; // É recomendado colocar exit após um header de redirecionamento
            
        } else {
            echo "Mensagem de erro: Faltam dados no formulário ou método incorreto.";
        }
    }
}