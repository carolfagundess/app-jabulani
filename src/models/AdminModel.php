<?php

class AdminModel
{

    public function getAdminByUsername($username)
    {

        require_once 'src/DAO/adminDAO.php';
        $dao = new AdminDAO();
        return $dao->getAdminByUsername($username);

    }
}