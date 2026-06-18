<?php

class BasicoController{
    public static function principal(){
        //logica do controlador
        $title = "Página Principal";
        $content = "Bem-vindo à página principal!";

        require_once 'src/views/admin/layout.php';
        
    }
    public static function sobre(){
        //logica do controlador
        $title = "Sobre Nós";
        $content = "Esta é a página sobre nós. Aqui você pode aprender mais sobre nossa empresa e equipe.";

        require_once 'src/views/admin/layout.php';
    }
    public static function erro(){
        //logica do controlador
        $title = "Erro ;(";
        $content = "Ops! A página que você está procurando não foi encontrada.";

        require_once 'src/views/admin/layout.php';
    }
}