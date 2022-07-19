<?php

namespace App\exceptions;

class ViewNotFoundException extends \Exception
{
    public $message = 'View not found';
}