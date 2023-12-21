<?php
    namespace application\core;

    use application\core\View;

    class Route{
        protected $routes = [];
        protected $params = [];

        // В файле Routes.php ищет существующие маршруты и создает массив маршрутов с помощью функции add()
        public function __construct(){
            $arr = require 'application/config/Routes.php';
            foreach($arr as $key => $value){
                $this->add($key, $value);
            }
        }

        // Создает регулярное выражение для URL и добавляет в массив
        public function add($route, $params){
            $route = '#^' . $route . '$#';
            $this->routes[$route] = $params;
        }

        // Получает текущий url, сравнивает с доступными. Возвращает true или false
        public function match(){
            $url = trim($_SERVER['REQUEST_URI'], '/');
            foreach($this->routes as $route => $params){
                if (preg_match($route, $url, $matches)){
                    $this->params = $params;
                    return true;
                }
            }
            return false;
        }

        // В случае, если в предыдущей функции url совпали, в этой функции ищется контроллер и экшн
        public function run(){
            if($this->match()){
                $path = 'application\controllers\\' . ucfirst($this-> params['controller'] . 'Controller');
                if (class_exists($path)){
                    $action = $this->params['action'] . 'Action';
                    if (method_exists($path, $action)){
                        $controller = new $path($this->params);
                        $controller->$action();
                    } else{
                        View::errorCode(404);
                    }
                } else{
                    View::errorCode(404);
                }
            } else{
                View::errorCode(404);
            }
        }
    }
?>