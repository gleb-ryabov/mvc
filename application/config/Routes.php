<?php
    // Маршруты страниц
    return [
        ''=> [
            'controller'=> 'account',
            'action'=> 'login',
        ],
        'login'=> [
            'controller'=> 'account',
            'action'=> 'login',
        ],

        'tasks'=> [
            'controller'=> 'tasks',
            'action'=> 'show',
        ],
        'migration'=> [
            'controller'=> 'migration',
            'action'=> 'sql',
        ],
    ];

?>