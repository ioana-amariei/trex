<?php
    include_once('config.php');

    class DbDriver {

        static function insertInto($table, $row) {
            $dbObject = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);

            $columns = array();
            $values = array();

            foreach($row as $key => $value) {
                $columns[] = $key;
                $values[] = $value;
            }

            $query = "INSERT INTO ".$table." ".self::stringifyKeys($columns)." VALUES ".self::stringifyValues($columns);
            $statement = $dbObject->prepare($query);

            $statement->execute($row);
        }

        static function stringifyKeys($array) {
            $finalResult = "(";

            foreach($array as $value) {
                $finalResult .= $value;

                if($value !== end($array)) {
                    $finalResult .= ",";
                }
            }

            $finalResult .= ")";

            return $finalResult;
        }

        static function stringifyValues($array) {
            $finalResult = "(";

            foreach($array as $value) {
                $finalResult .= ':'.$value;

                if($value !== end($array)) {
                    $finalResult .= ",";
                }
            }

            $finalResult .= ")";

            return $finalResult;
        }

        static function executeQuery($query) {
            $dbObject = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);

            $statement = $dbObject->prepare($query); 
            $statement->execute(); 

            $result = $statement->fetchAll();

            if(sizeof($result) > 0)
                return $result;

            return null;
        }
    }
?>