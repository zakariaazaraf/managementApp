<?php 
    class Employee{

        /* public $Id;
        public $FirstName;
        public $LastName;
        public $Email;
        public $Age;
        public $Salary;
        public $Tax; */

        private $Id;
        private $FirstName;
        private $LastName;
        private $Email;
        private $Age;
        private $Salary;
        private $Tax;


        // IF YOU WANT TO BIND THE DATA WITH THE CLASS IT DOESN'T MAKE SENSE TO MAKE THIS CONSTRUCTOR

        /* public function __construct($firstname, $lastname, $email, $age, $salary, $tax){
            //$this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->age = $age;
            $this->salary = $salary;
            $this->tax = $tax;
        } */

        // TO ACESS VARIABLES 
        public function __get($props){
            return $this->$props;
        }

        public function calculateSalary(){
            return $this->Salary - (($this->Salary * $this->Tax) / 100);
        }
    }
?>