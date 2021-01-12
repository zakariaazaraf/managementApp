<?php 

    require_once('db.php');
    require_once('employee.php');

    

    $employee = new Employee();

    

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
        $salary = filter_input(INPUT_POST, 'salary', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $tax = filter_input(INPUT_POST, 'tax', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        
        if($db->exec("INSERT INTO employee set FirstName = '$firstname',
                                                LastName = '$lastname',
                                                Email = '$email',
                                                Age = '$age',
                                                Salary = '$salary',
                                                Tax = '$tax'")){
            $message = "$firstname Inserted successfully";
            $success = true;
        }else{
            $message = "$firstname Encountre some Issues";
            $succes = false;
        }

        /* echo "Info: $firstname, $lastname, $age, $email, $salary, $tax";
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        $_POST = array();
        unset($_POST); */
    }

    $query = "select * from employee";
    $stat = $db->query($query);
    /* $result = $stat->fetchAll(PDO::FETCH_BOTH); */
    /* $result = $stat->fetchAll(PDO::FETCH_ASSOC); */
    /* $result = $stat->fetchAll(PDO::FETCH_OBJ); */

    // PROFESSIONAL MAKE THE DATA MAP THE CLASS => "Object Relationel Maping"
    $result = $stat->fetchAll(PDO::FETCH_CLASS, 'Employee');

    $result = (is_array($result) && !empty($result)) ? $result : false;

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
                <form class='formApp' method='POST' enctype="application/x-www-form-urlencoded">
                <fieldset>

                    <legend>Employee Information:</legend>
                     <?php if(isset($message)){?>
                             <p class="message<?= $success ? ' success': ' failed'?>"> <?= $message?> </p> 
                        <?php } ?>
                    
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
                        <th>tax %</th>
                    </tr>
                    
                </thead>
                <tbody>

                    <?php if($result){foreach($result as $res){?>

                        <tr>
                            <td><?= $res->Id ?></td>
                            <td><?= $res->FirstName ?></td>
                            <td><?= $res->LastName ?></td>
                            <td><?= $res->Email ?></td>
                            <td><?= $res->Age ?></td>
                            <td><?= $res->calculateSalary() ?> DH</td>
                            <td><?= $res->tax ?></td>
                        </tr>

                        <?php
                        }
                    }else{
                        echo "<td colspan='7'>We Haven't Any Data To Desplay !</td>";
                    }?>
                    
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>