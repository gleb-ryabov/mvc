<?php

    namespace application\controllers;

    use application\core\Controller;

    class TasksController extends Controller{
        public function showAction(){
            $this->view->render('Список задач');
        }
    }
?>