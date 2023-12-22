<?php

    namespace application\controllers;

    use application\core\Controller;

    class TasksController extends Controller{

        public $id;

        public function showAction(){

            $this->id = $_SESSION["id"];

            if(isset($_POST['type'])){
                $type = $_POST['type'];
                switch ($type){
                    case 'newTask':
                        // Добавление новой задачи
                        $newTask = $this->model->newTask($this->id, $_POST['description']);
                        break;
                    case 'deleteAllTasks':
                        // Удаление всех задач
                        $this->model->deleteTask($this->id);
                        break;
                    case 'deleteOneTask':
                        // Удаление одной конкретной задачи
                        $this->model->deleteTask($this->id, $_POST['taskId']);
                        break;
                    case 'updateAllTasks':
                        // Пометить все задачи выполненными
                        $this->model->updateStatusTask($this->id);
                        break;
                    case 'updateOneTask':
                        // Изменить статус одной конкретной задачи
                        $this->model->updateStatusTask($this->id, $_POST['taskId'], $_POST['statusTask']);
                        break;
                }
            }

            // Получение задач пользователя
            $tasks = $this->model->getTasks($this->id);

            // Вывод страницы задач
            $this->view->render('Список задач', ['css' => 'tasks', 'tasks' => $tasks]);
        }

    }
?>