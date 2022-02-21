<?php

namespace crud\controller;

use crud\model\ClassSign;
use PDO;

class ControllerLogin
{
    public function processaRequisicao()
    {   
        
        //Inserção de usuário
        if (isset($_POST['insert']) && !empty($_POST['insert'])) {
            $sign = new ClassSign();
            $sign->inserindo();
        };

        //Atualização de registros de usuário
        if (isset($_POST['update']) && !empty($_POST['update'])) {
            $sign = new ClassSign();
            $sign->atualizando();
        };

        //Deleção de usuário
        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $sign = new ClassSign();
            $sign->deletando();
        }

        //Listando usuários registrados
        $listagem = ClassSign::listando();


        require __DIR__ . '/../../view/superior.php';
        require __DIR__ . '/../../view/index.php';
        require __DIR__ . '/../../view/inferior.php';
    }
}