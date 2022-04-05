<?php

namespace crud\controller;

use crud\model\ClassSign;

class ControllerLogin
{
    public function processRequest()
    {   
        //Inserção de usuário
        if (isset($_POST['insert']) && !empty($_POST['insert'])) {
            $sign = new ClassSign();
            $sign->inserting();
        }

        //Atualização de registros de usuário
        if (isset($_POST['update']) && !empty($_POST['update'])) {
            $sign = new ClassSign();
            $sign->updating();
        }

        //Deleção de usuário
        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $sign = new ClassSign();
            $sign->deleting();
        }

        //Listando usuários registrados
        $listagem = ClassSign::listing();

        require __DIR__ . '/../../view/header.php';
        require __DIR__ . '/../../view/index.php';
        require __DIR__ . '/../../view/footer.php';
    }
}