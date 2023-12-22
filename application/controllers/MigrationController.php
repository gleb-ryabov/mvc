<?php

    namespace application\controllers;

    use application\core\Controller;

    class MigrationController extends Controller{
        public function sqlAction(){

            // Вызов функций миграции
            $files = $this->model->getMigrationFiles();
            if (!(empty($files))) {
                echo 'Начинаем миграцию...<br><br>';
                foreach ($files as $file) {
                    $this->model->migrate($file);
                    echo basename($file) . '<br>';
                }
                echo '<br>Миграция завершена.';  
            } else{
                echo 'Ваша база данных в актуальном состоянии.';
            }

            // Вывод 
            $this->view->render('Миграция', ['css' => '404']);
        }
    }
?>