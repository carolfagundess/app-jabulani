<?php

class AdminController
{

    public static function formLogin()
    {
        $acao = 'autenticacao';

        require_once 'src/views/admin/formLogin.php';
    }

    public static function autenticar()
    {
        echo "Autenticando usuário...";
    }

}