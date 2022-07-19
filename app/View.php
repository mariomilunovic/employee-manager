<?php

    declare(strict_types=1);

    namespace App;

    use App\exceptions\ViewNotFoundException;

    class View 
    {
        public function __construct (protected string $view, protected array $params1 = [], protected array $params2 = [])
        {      

        }

        public function render():string
        {
            $viewPath = VIEW_PATH.DIRECTORY_SEPARATOR.$this->view.'.php';

            if(!file_exists($viewPath))
            {
                throw new ViewNotFoundException();
            }

            //converts array keys into variable names and array values into variable value            
            extract($this->params1);
            extract($this->params2);

            ob_start();

                //page layout
                include_once '../views/components/header.php';
                include_once '../views/components/nav.php';
                include_once '../views/components/message.php';

                include $viewPath;

                include_once '../views/components/footer.php';

            return (string)(ob_get_clean());
        }

    }
