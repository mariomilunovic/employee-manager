<?php

namespace App\exceptions;

class RouteNotFoundException extends \Exception
{
    public $message = 'Error 404 - Page not found';    
}