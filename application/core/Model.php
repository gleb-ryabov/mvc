<?php

    namespace application\core;

    use application\lib\DB;

    abstract class Model{

        public $db;

        public function __construct(){
            $this->db = new Db;
        }
    }
?>