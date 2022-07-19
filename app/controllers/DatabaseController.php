<?php

namespace App\controllers;

use App\View;
use App\database\DB;

class DatabaseController
{
  
    public function options ()
    {              
        $view = (new View('pages/db_options'))->render();
        echo $view;
    }

    public function reset ()
    {       

        $query  = file_get_contents(__DIR__.'/../database/sql.txt');

        $db = DB::getInstance(); 

        $db->pdo->exec($query);    
        
        $_SESSION["msg"]='Database restored!';

        header('location:/employees');        
        
    }
}