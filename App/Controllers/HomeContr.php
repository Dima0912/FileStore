<?php

namespace App\Controllers;


class HomeControll
{
    protected function index()
    {
        $result = [
            'controller' => 'HomeController',
            'action' => 'index',
            'params' => []
        ];
        dd($result);
    }

    public function show($id)
    {
        $result = [
            'controller' => 'HomeController',
            'action' => 'show',
            'params' => [
                'id' => $id
            ]
        ];
        dd($result);
    }
}
