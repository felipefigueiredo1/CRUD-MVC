<?php

namespace crud\controller;

use crud\controller\ControllerLogin;

class ControllerRoutes 
{
    public static function routes()
    {
        //Array de rotas para controllers disponiveis
        return [
            '/'     => ControllerLogin::class,
            'login' => ControllerLogin::class
        ];
    }
}