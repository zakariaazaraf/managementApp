<?php 

    require_once 'abstractModel.php'; 

    class Employee extends AbstractModel{

        public static $db;

        private $Id;
        private $FirstName;
        private $LastName;
        private $Email;
        private $Age;
        private $Salary;
        private $Tax;

        protected static $primaryKey = 'Id';
        protected static $tableName = "employee";
        protected static $tableSchema = array(
            //'Id'               => self::DATA_TYPE_INT,
            'FirstName'        => self::DATA_TYPE_STR,
            'LastName'         => self::DATA_TYPE_STR,
            'Email'            => self::DATA_TYPE_STR,
            'Age'              => self::DATA_TYPE_INT,
            'Salary'           => self::DATA_TYPE_DECIMAL,
            'Tax'              => self::DATA_TYPE_DECIMAL
        );
       

        public function __construct( $firstname, $lastname, $email, $age, $salary, $tax){
            //$this->Id = $id;
            $this->FirstName = $firstname;
            $this->LastName = $lastname;
            $this->Email = $email;
            $this->Age = $age;
            $this->Salary = $salary;
            $this->Tax = $tax; 
        }

        // TO ACESS VARIABLES 
        public function __get($props){
            return $this->$props;
        }

        public function setFirsName($name){
            $this->FirstName = $name;
        }

        public function calculateSalary(){
            return $this->Salary - (($this->Salary * $this->Tax) / 100);
        }

    }
?>