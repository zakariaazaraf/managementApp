<?php
    require_once('db.php'); 
    require_once 'employee.php';


    $employee = new Employee(22, 'aaa', 'aaa', 'aa@aa.com', 23, 7000, 2.3);
    echo "<pre>";
    var_dump($employee->create());
    echo "</pre>";