<?php

class UsuarioModel
{

    public function getUsuarioByUsername($username)
    {

        require_once 'src/DAO/usuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->getUsuarioByUsername($username);

    }

    public function inserirUsuario(string $nomeUsuario, string $email, string $senha, string $tipoUsuario = 'participante'): bool
    {
        require_once 'src/DAO/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->inserirUsuario($nomeUsuario, $email, $senha, $tipoUsuario);
    }
}