<?php

class UsuarioModel
{

    public function getUsuarioByUsername($username)
    {
        require_once 'src/DAO/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->getUsuarioByUsername($username);
    }

    public function getUsuarioById(int $id)
    {
        require_once 'src/DAO/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->getUsuarioById($id);
    }

    public function inserirUsuario(string $nomeUsuario, string $email, string $senha, string $tipoUsuario): bool
    {
        require_once 'src/DAO/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->inserirUsuario($nomeUsuario, $email, $senha, $tipoUsuario);
    }

    public function atualizarUsuario(int $id, string $nomeUsuario, string $email, string $telefone = ''): bool
    {
        require_once 'src/DAO/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->atualizarUsuario($id, $nomeUsuario, $email, $telefone);
    }

    public function deletarUsuario(int $id): bool
    {
        require_once 'src/DAO/UsuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->excluirUsuario($id);
    }
}