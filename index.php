<?php

    use application\core\Route;

    // Автозагрузчик классов
    spl_autoload_register(function ($class) {
        $path = str_replace("\\", "/", $class . ".php");
        if (file_exists($path)) {
            require $path;
        }
    });

    session_start();
    
    // Маршрутизация страниц
    $route = new Route();
    $route-> run();
?>