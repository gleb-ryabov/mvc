<?php

    namespace application\lib;

    use PDO, PDOException;

    class Db {

        protected $db;

        // Подключение к БД
        public function __construct(){

            // Данные для подключения к БД
            $config = require 'application/config/db.php';

            try{
                $this->db = new PDO('mysql:dbname=' . $config['name'] . ';host=' . $config['host'], 
                    $config['user'], $config['password']);
            } catch(PDOException $e){
                echo "Error connecting to the database: " . $e->getMessage();
                die;
            }

        }

        /**
         * Функция возвращает подготовленный SQL запрос
         * @param string $query
         * @param array $params
         * @return \PDOStatement|bool $stmt
         */
        public function query($query, $params = []){
            $stmt = $this->db->prepare($query);
            if (!empty($params)){
                foreach ($params as $key => $value){
                    $stmt->bindValue(':' . $key, $value);
                }
            }
            $stmt->execute();
            return $stmt;
        }
        
        /**
         * Функция возвращет в массиве строку/строки из БД
         * @param string $query
         * @param array $params
         * @return array
         */
        public function query_row($query, $params = []){
            $result = $this->query($query, $params);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * Функция возвращет одиночное значение из БД
         * @param string $query
         * @param array $params
         * @return mixed
         */
        public function query_column($query, $params = []){
            $result = $this->query($query, $params);
            return $result->fetchColumn();
        }

        /** 
         * Функция возвращает последний внесенный в БД ID
         * @return int
         */
        public function lastID(){
            return $this->db->lastInsertId();
        }
    }
?>