<?php 
    class Employee{
        public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $age;
        public $tax;

        public function __construct($id, $firstname, $lastname, $email, $age){
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->age = $age;
        }

        public function calculateSalary(){
            return $this->salary - (($this->salary * $this->tax) / 100);
        }
    }
?>