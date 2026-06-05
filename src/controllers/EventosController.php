<?php

class EventosController{
    public static function listarEventos()
    {
        require_once 'src/models/EventoModel.php';

        $model = new EventoModel();
        $listaEventos = $model->getEventos();

        require 'src/views/eventoView.php';
    }
}