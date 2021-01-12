<?php 

    require_once('db.php');
    require_once('employee.php');

    /* if($db->exec("INSERT INTO employee set FirstName = 'زكرياء', LastName = 'الأزرف', Email = 'zakariaazaraf@gmail.com', Age = 23 ")){
        echo "The Record Inserted successfully";
    }else{
        echo "We Encountre some Issues";
    } */

    $employee = new Employee();

    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
    $salary = filter_input(INPUT_POST, 'salary', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $tax = filter_input(INPUT_POST, 'tax', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    

    $query = "select * from employee";
    $stat = $db->query($query);
    /* $result = $stat->fetchAll(PDO::FETCH_BOTH); */
    /* $result = $stat->fetchAll(PDO::FETCH_ASSOC); */

    // PROFESSIONAL MAKE THE DATA MAP THE CLASS => "Object Relationel Maping"
    /* $result = $stat->fetchAll(PDO::FETCH_OBJ); */
    $result = $stat->fetchAll(PDO::FETCH_CLASS, 'Employee');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Example</title>
    <link rel="stylesheet" href="main.css"/>
</head>
<body>
    <div class="wrapper">
        
            <div class="form-info">
                <form class='formApp' action='<?php $_SERVER['PHP_SELF'] ?>'>
                <fieldset>

                    <legend>Employee Information:</legend>

                    <div class="form-group">
                        <label for="firstname">firstname:</label>
                        <input type="text" id="firstname" name="firstname" required>
                    </div>
                    

                    <div class="form-group">
                        <label for="lastname">lastname:</label>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">email:</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="age">age:</label>
                        <input type="number" id="age" name="age" required min="20" max="75">
                    </div>
                    
                    <div class="form-group">
                        <label for="salary">salary:</label>
                        <input type="number" id="salary" name="salary" required min="2000" max="10000" step="25">
                    </div>
                    
                    <div class="form-group">
                        <label for="tax">tax:</label>
                        <input type="number" id="tax" name="tax" required min="1" max="5" step='.1'>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" value="Save">
                    </div>
                </fieldset>
            </form>
            </div>
            
        
        <div class="data">
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>email</th>
                        <th>age</th>
                        <th>salary</th>
                        <th>tax</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php foreach($result as $res){?>
                        <tr>
                            <td><?= $res->Id ?></td>
                            <td><?= $res->FirstName ?></td>
                            <td><?= $res->LastName ?></td>
                            <td><?= $res->Email ?></td>
                            <td><?= $res->calculateSalary() ?></td>
                            <td><?= $res->tax ?></td>
                        </tr>
                        <?php
                    }?>
                    
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>