<?php 
    class Employee{

        /* public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $age;
        public $salary;
        public $tax; */

        private $id;
        private $firstName;
        private $lastName;
        private $email;
        private $age;
        private $salary;
        private $tax;

        // IF YOU WANT TO BIND THE DATA WITH THE CLASS IT DOESN'T MAKE SENSE TO MAKE THIS CONSTRUCTOR

        public function __construct($id, $firstname, $lastname, $email, $age){
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->age = $age;
        }

        // TO ACESS VARIABLES 
        public function __get($props){
            return $this->$props;
        }

        public function calculateSalary(){
            return $this->salary - (($this->salary * $this->tax) / 100);
        }
    }
?>