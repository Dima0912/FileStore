<?php

namespace App\Controller;


class PageController 
{
    private array $param;

    public function __construct($param = NULL){
        $this->param = $param;
    }

    public function index()
    {
        if($this->param){
            echo 'PageController with params' . '<br/>';
            foreach ($this->param as $key => $value){
                echo $key . ' => ' . $value;
            }
            return;
        }
        echo 'PageController';
    }
}