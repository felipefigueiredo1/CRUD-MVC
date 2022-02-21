<?php

namespace crud\controller;

use crud\controller\ControllerLogin;

class ControllerRotas 
{
    public static function rotas()
    {
        return [
            '/'     => ControllerLogin::class,
            'login' => ControllerLogin::class
        ];
    }
}