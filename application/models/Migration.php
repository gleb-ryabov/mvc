<?php

    namespace application\models;

    use application\core\Model;
    use PDO;

    class Migration extends Model{

        // Переменная данных  для подключения к БД
        public $config;
        

        /**
         * Функция, возвращающая список файлов для миграции
         * @return string[] - массив строк с именами файлов для миграции
         */
        function getMigrationFiles() {

            // Данные для подключения к БД
            $this->config = require 'application/config/db.php';

            // Директория SQL
            $sqlFolder = __DIR__ . '/../config/sql';
            $allFiles = glob($sqlFolder . '/*.sql');
        
            $query = "SHOW TABLES LIKE '" . $this->config['versions_table'] . "'";
            $result = $this->db->query($query);
            $firstMigration = ($result->rowCount() === 0);
            
            if ($firstMigration) {
                return $allFiles;
            }
        
            $versionsFiles = array();
            $query = "SELECT `name` FROM " . $this->config['versions_table'] ;
            $data = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                array_push($versionsFiles, $sqlFolder . '/' . $row['name']);
            }
        
            return array_diff($allFiles, $versionsFiles);
        }

        /** Функция миграции
         * @param string $file - название файла sql
         */
        function migrate($file) {
            // Данные для подключения к БД
            $this->config = require 'application/config/db.php';

            //Выполнение mysql-запроса из внешнего файла
            $command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', $this->config['user'], 
                $this->config['password'], $this->config['host'], $this->config['name'], $file);    
            shell_exec($command);
        
            $baseName = basename($file);
            $query = "INSERT INTO " .$this->config['versions_table'] . " (`name`) values('$baseName')";
            $this->db->query($query);
        }

    }
?>