<?php

declare(strict_types = 1);

define('VIEW_PATH', __DIR__.'/../views');

use App\View;
use App\Router;
use App\controllers\PageController;
use App\controllers\SearchController;
use App\controllers\DatabaseController;
use App\controllers\EmployeeController;
use App\controllers\JobPositionController;
use App\exceptions\RouteNotFoundException;


session_start();

spl_autoload_register(function($class){

    $path = __DIR__.'/../'.lcfirst(str_replace('\\','/',$class)).'.php'; 
    
    require $path;
    
});

try 
{
    $router = new Router();

    //register all routes
    $router

        ->get('/',[PageController::class,'home'])

        //Database Routes
        ->get('/db_options',[DatabaseController::class,'options'])
        ->get('/db_reset',[DatabaseController::class,'reset'])

        //Employee Routes
        ->get('/employees',[EmployeeController::class,'index'])
        ->get('/employees/create',[EmployeeController::class,'create'])
        ->post('/employees/create',[EmployeeController::class,'store'])
        ->get('/employees/edit',[EmployeeController::class,'edit'])
        ->post('/employees/update',[EmployeeController::class,'update'])
        ->get('/employees/delete',[EmployeeController::class,'delete'])
        ->get('/employees/destroy',[EmployeeController::class,'destroy'])

        //JobPosition Routes
        ->get('/jobpositions',[JobPositionController::class,'index'])
        ->get('/jobpositions/create',[JobPositionController::class,'create'])
        ->post('/jobpositions/create',[JobPositionController::class,'store'])
        ->get('/jobpositions/edit',[JobPositionController::class,'edit'])
        ->post('/jobpositions/update',[JobPositionController::class,'update'])
        ->get('/jobpositions/delete',[JobPositionController::class,'delete'])
        ->get('/jobpositions/destroy',[JobPositionController::class,'destroy'])

        //Search Routes
        ->post('/search',[SearchController::class,'search'])
                
        ;

        
    //return controller method
    $router
        ->resolve($_SERVER['REQUEST_URI'],
        strtolower($_SERVER['REQUEST_METHOD']));
} 

catch(RouteNotFoundException $e) {
    http_response_code(404);
    $_SESSION["msg"]='Error 404 - Route not found';
    echo (new View('components/message'))->render();
    
}