<?php

class UsuarioModel
{

    public function getUsuarioByUsername($username)
    {

        require_once 'src/DAO/usuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->getUsuarioByUsername($username);

    }
}