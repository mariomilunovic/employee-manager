<?php

    declare(strict_types=1);

    namespace App;    

    use App\exceptions\RouteNotFoundException;

    class Router
    {   
        public array $routes;

        //create associative array ['route' => 'action']
        public function register (string $requestMethod, string $route, array|callable $action): self
        {
            $this->routes[$requestMethod][$route] = $action;

            return $this;
        }

        public function get ( string $route, array|callable $action): self
        {       
            return $this->register('get', $route, $action);
        }

        public function post ( string $route, array|callable $action): self
        {       
            return $this->register('post', $route, $action);
        }

        //get action for registered route
        public function resolve (string $requestUri, string $requestMethod)
        {
            // get first part of $REQUEST_URI string (discard query string)
            $route = explode('?',$requestUri)[0]; 


            // check if route is already registered
            $action = $this->routes[$requestMethod][$route] ?? null;


            // throw error if route is not registered
            if(!$action) {
                throw new RouteNotFoundException();
            }

            if (is_callable($action))
            {
                return call_user_func($action);
            }

            if (is_array($action)) //$action is array [$class,$method]
            {
                [$class,$method] = $action; 

                if(class_exists($class))
                {
                    $class = new $class();
                    if(method_exists($class,$method))
                    {
                        return call_user_func_array([$class,$method],[]);
                    }

                }
                                
            }

            throw new RouteNotFoundException();

        }
    }