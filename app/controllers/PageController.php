<?php

namespace App\controllers;

use App\View;

class PageController
{
    public function home()
    {
        $view = (new View('pages/home'))->render();
        echo $view;
    } 

}