<?php

    class AbstractModel {

        // DATA TYPES
        CONST DATA_TYPE_BO0L = PDO::PARAM_BOOL;
        CONST DATA_TYPE_STR = PDO::PARAM_STR;
        CONST DATA_TYPE_INT = PDO::PARAM_INT;
        CONST DATA_TYPE_DECIMAL = 5;

        protected function prepareValues(){

        }

        private static function buildNamesParamsSQL(){
            $params = '';
            foreach(static::$tableSchema as $columnName => $value){
                $params .= "$columnName = :$columnName, ";
            }
            return trim($params, ', ');
        }

        public function create(){

            global $db;

            $sql = "INSERT INTO " . static::$tableName . " SET " . self::buildNamesParamsSQL();
            $stat = $db->prepare($sql);

            //return var_dump($stat);

            // SANITIZE AND BIND PARAMS
            foreach(static::$tableSchema as $column => $type){
                if($type == 5){
                    echo $this->$column;
                }else{
                    echo $this->$column;
                }
            }

            var_dump($this);
        }
    }