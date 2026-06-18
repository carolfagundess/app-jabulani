<?php 

class UserModel
{

    public function getUserByUsername($username)
    {

        require_once 'src/DAO/userDAO.php';
        $dao = new UserDAO();
        return $dao->getUserByUsername($username);

    }
}