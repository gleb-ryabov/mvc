<?php

    namespace application\models;

    use application\core\Model;

    class Account extends Model{

        /**
         * Функция, возвращающая данные о пользователе
         * @param string $login 
         * @param string $password
         * @return array
         */
        public function getAccount($login, $password){
            $params = ['login' => $login, 'password' => $password];
            return $this->db->query_row("SELECT * FROM users WHERE login = :login AND password = :password", $params);
        }

        /**
         * Функция, проверяющая по логину, существует ли аккаунт
         * @param string $login 
         * @return bool - если аккаунт существует - true, если не существует - false
         */
        public function checkAccount($login){
            $params = ['login' => $login];
            $result = $this->db->query_row("SELECT id FROM users WHERE login = :login", $params);
            if (empty($result)){
                return false;
                
            }
            return true;
        }

        /**
         * Функция, создающая новый аккаунт
         * @param string $login 
         * @param string $password
         * @return int - возвращает ID созданного пользователя
         */
        public function newAccount($login, $password){
            $current_time = date("Y-m-d H:i:s");
            $params = ['login' => $login, 'password' => $password, 'time' => $current_time];
            $this->db->query("INSERT INTO users (id, login, password, created_at) VALUES 
                (NULL, :login, :password, :time)", $params);
            return $this->db->lastId();
        }
    }
?>