<?php 
    class Employee{
        
        public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $age;
        public $salary;
        public $tax;

        // IF YOU WANT TO BIND THE DATA WITH THE CLASS IT DOESN'T MAKE SENSE TO MAKE THIS CONSTRUCTOR

        /* public function __construct($id, $firstname, $lastname, $email, $age){
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->age = $age;
        }
 */
        public function calculateSalary(){
            return $this->salary - (($this->salary * $this->tax) / 100);
        }
    }
?>