<?php

    namespace application\models;

    use application\core\Model;

    class Tasks extends Model{

        /**
         * Функция, возвращающая все задачи пользователя
         * @param int $id
         * @return array
         */
        public function getTasks($id){
            $params = ['id' => $id];
            return $this->db->query_row("SELECT tasks.id, description, tasks.created_at, status FROM tasks 
            JOIN users ON users.id = tasks.user_id WHERE users.id= :id ORDER BY tasks.created_at DESC", $params);
        }

        /**
         * Функция, создающая новую задачу
         * @param int $id
         * @param string $description
         * @return int - id добавленной задачи
         */
        public function newTask($id, $description){

            $current_time = date("Y-m-d H:i:s");

            $params = ["id" => $id, "description" => $description, "time" => $current_time];
            $this->db->query("INSERT INTO tasks (id, user_id, description, created_at, status) 
            VALUES (NULL, :id, :description, :time, 'in work')", $params);

            return $this->db->lastId();
        }

        /**
         * Функция, удаляющая задачу
         * @param int $id
         * @param int $taskId
         */
        public function deleteTask($id, $taskId = 0){
            if ($taskId != 0){
                //Зарос на удаление одной задачи
                $params = ["task" => ($taskId), "id" => $id];
                $this->db->query("DELETE from tasks WHERE id = :task AND user_id = :id", $params);
            } else{
                //Зарос на удаление всех задач
                $params = ["id" => $id];
                $this->db->query("DELETE from tasks WHERE user_id = :id", $params);
            }
        }

        /**
         * Функция, изменяющая статус задачи
         * @param int $id
         * @param int $taskId
         * @param string $statusTask
         */
        public function updateStatusTask($id, $taskId = 0, $statusTask = ''){
            if ($taskId != 0){
                //Зарос на изменение статуса задачи

                //Подбор нового статуса задачи
                $newStatusTask = "in work";
                if ($statusTask == "in work"){
                    $newStatusTask = "complited";
                }

                // Запрос 
                $params = ["status" => $newStatusTask,"task" => $taskId, "id" => $id];
                $this->db->query("UPDATE tasks SET status = :status WHERE id = :task AND user_id = :id", $params);

            } else{
                //Зарос на отметку всех задач, как выполненных
                $params = ["id" => $id];
                $this->db->query("UPDATE tasks SET status = 'complited' WHERE user_id = :id", $params);
            }
        }
    }
?>