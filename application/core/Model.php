<?php

    namespace application\core;

    use application\lib\DB;

    abstract class Model{

        public $db;

        public function __construct(){
            // Подключение к БД для работы с моделями
            $this->db = new Db;
        }
    }
?>