<?php

    class AbstractModel {

        // DATA TYPES
        CONST DATA_TYPE_BO0L = PDO::PARAM_BOOL;
        CONST DATA_TYPE_STR = PDO::PARAM_STR;
        CONST DATA_TYPE_INT = PDO::PARAM_INT;
        CONST DATA_TYPE_DECIMAL = 5;

        private function prepareValues(PDOStatement &$stat){

            // SANITIZE AND BIND PARAMS
            foreach(static::$tableSchema as $column => $type){
                if($type == 5){ 
                    // SANITAIZE THE INPUT AND BIND IT           
                    $stat->bindValue(":{$column}", filter_var($this->$column, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
                    
                }else{
                    // BIND THE INPUT AND IT'S ALREADY SANITIZED USIND THE PDO VAIDATION
                    $stat->bindValue(":{$column}", $this->$column, $type);       
                }
            }
        }

        private static function buildNamesParamsSQL(){
            $params = '';
            foreach(static::$tableSchema as $columnName => $value){
                $params .= "$columnName = :$columnName, ";
            }
            return trim($params, ', ');
        }

        // CREATE A NEW RECORD
        public function create(){
            global $db;

            $sql = "INSERT INTO " . static::$tableName . " SET " . self::buildNamesParamsSQL();
            $stat = $db->prepare($sql);
            $this->prepareValues($stat);

            return $stat->execute();       
        }

        // UPDATE A RECORD
        public function update(){
            global $db;

            $sql = "UPDATE " . static::$tableName . " SET " 
                    . self::buildNamesParamsSQL() 
                    . " WHERE " 
                    . static::$primaryKey . " = " 
                    . $this->{static::$primaryKey};

            $stat = $db->prepare($sql);
            $this->prepareValues($stat);

            return $stat->execute();
        
        }

        // DELETE A RECORD
        public function delete(){
            global $db;

            $sql = "DELETE FROM " . static::$tableName 
                    . " WHERE " 
                    . static::$primaryKey . " = " 
                    . $this->{static::$primaryKey};

            /* $stat = $db->prepare($sql);

            return $stat->execute(); */
            echo $sql;
        
        }
    }