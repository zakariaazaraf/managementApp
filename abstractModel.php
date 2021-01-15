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
        private function create(){
            global $db;

            $sql = "INSERT INTO " . static::$tableName . " SET " . self::buildNamesParamsSQL();
            $stat = $db->prepare($sql);
            $this->prepareValues($stat);

            return $stat->execute();       
        }

        // UPDATE A RECORD
        private function update(){
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

        // REPLACE CREATE AND UPDATE BY SAVE FUNCTION
        public function save(){
            return $this->{static::$primaryKey} === null ? $this->create() : $this->update();
        }

        // DELETE A RECORD
        public function delete(){
            global $db;

            $sql = "DELETE FROM " . static::$tableName 
                    . " WHERE " 
                    . static::$primaryKey . " = " 
                    . $this->{static::$primaryKey};

            $stat = $db->prepare($sql);
            return $stat->execute(); 
        }

        public static function getAll(){
            global $db;
            $sql = "SELECT * FROM " . static::$tableName;
            $stat = $db->prepare($sql);
            // get_called_class() => THE NAME OF THE CLASS THAT CALLED THIS FUNCTION
            return $stat->execute() 
                                    ? $stat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
                                                        get_called_class(),
                                                        array_keys(static::$tableSchema)
                                                    ) 
                                    : false;
        }

        public static function getByPk($pk){
            global $db;
            $sql = "SELECT * FROM " . static::$tableName . " WHERE " 
                                    . static::$primaryKey . " = " 
                                    . $pk;
            $stat = $db->prepare($sql);
            // get_called_class() => THE NAME OF THE CLASS THAT CALLED THIS FUNCTION
            if($stat->execute()){
                $obj = $stat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
                                                        get_called_class(),
                                                        array_keys(static::$tableSchema)
                );

                return array_shift($obj);           
                
            }                            
            return false; 
        }
    }