<?php

    namespace application\core;

    class View{
        
        public $path;
        public $route;
        public $layout = 'default';

        // Получает и создает путь
        public function __construct($route){
            $this->route = $route;
            $this->path = $route['controller'] . '/' . $route['action'];
        }

        // Открывает страницу, собирая ее из layout и view
        public function render ($title, $vars = []){
            $path = 'application/view/' . $this->path . '.php';
            if (file_exists($path)){
                ob_start();
                require $path;
                $content = ob_get_clean();
                require 'application/view/layouts/' . $this->layout . '.php';
            } else{
                echo "Вид не найден: " . $this->path;
            }
        }

        // Открвыает страницу с ошибкой
        public static function errorCode($code){
            http_response_code($code);
            $path = 'application/view/errors/' . $code . '.php';
            if (file_exists($path)){
                require $path;
            }
            exit;
        }
    }
?>