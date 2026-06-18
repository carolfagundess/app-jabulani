<<<<<<< HEAD
<?php

class UsuarioModel
{

    public function getUsuarioByUsername($username)
    {

        require_once 'src/DAO/usuarioDAO.php';
        $dao = new UsuarioDAO();
        return $dao->getUsuarioByUsername($username);
=======
<?php 

class UserModel
{

    public function getUserByUsername($username)
    {

        require_once 'src/DAO/userDAO.php';
        $dao = new UserDAO();
        return $dao->getUserByUsername($username);
>>>>>>> 40d1d1b146795198e080c14469ec2546fef4862d

    }
}