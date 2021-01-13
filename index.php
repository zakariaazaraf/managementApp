<?php 

    require_once('db.php');
    require_once('employee.php');

    
    $employee = new Employee();

    if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if($id > 0){

            $query = "select * from employee WHERE Id = :id";
            $stat = $db->prepare($query);
            $stat->execute(array(':id' => $id));
            $data = $stat->fetchAll(PDO::FETCH_CLASS, 'Employee');

            $data = (is_array($data) && !empty($data)) ? array_shift($data) : false;
            
            echo "<pre>";
            print_r($data->FirstName);
            echo "</pre>";
        }   
    }

    

    if(isset($_POST['submit'])){

        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
        $salary = filter_input(INPUT_POST, 'salary', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $tax = filter_input(INPUT_POST, 'tax', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        //$employee = new Employee($firstname, $lastname, $email, $age, $salary, $tax);

        $query = "INSERT INTO employee set FirstName = :firstname,
                                            LastName = :lastname,
                                            Email = :email,
                                            Age = :age,
                                            Salary = :salary,
                                            Tax = :tax";

        $stat = $db->prepare($query);
        
       /*  if($stat->execute(array(
            ':firstname' => $firstname,
             ':lastname' => $lastname,
              ':email' => $email,
               ':age' => $age,
                ':salary' => $salary,
                 ':tax' => $tax
                 ))){
            $message = "$firstname Inserted successfully";
            $success = true;
        }else{
            $message = "$firstname Encountre some Issues";
            $succes = false;
        } */

    }

    

    $query = "select * from employee";
    $stat = $db->query($query);

    /* $result = $stat->fetchAll(PDO::FETCH_BOTH); */
    /* $result = $stat->fetchAll(PDO::FETCH_ASSOC); */
    /* $result = $stat->fetchAll(PDO::FETCH_OBJ); */

    // PROFESSIONAL MAKE THE DATA MAP THE CLASS => "Object Relationel Maping"
    /* $result = $stat->fetchAll(PDO::FETCH_CLASS, 'Employee'); */

    
    
    $result = $stat->fetchAll(PDO::FETCH_CLASS, 'Employee');

    $result = (is_array($result) && !empty($result)) ? $result : false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Example</title>
    <link rel="stylesheet" href="all.min.css"/>
    <link rel="stylesheet" href="main.css?v=<?= time(); ?>"/>
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
                        <th>control</th>
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
                            <td><?= $res->calculateSalary()?> DH</td>
                            <td><?= $res->Tax ?></td>
                            <td>
                                <a href='index.php?action=edit&id=<?= $res->Id?>'><i class="fas fa-edit"></i></a>
                                <a href='index.php ?action=delete&id=<?= $res->Id?>'><i class='fas fa-trash'></i></a>
                            </td>
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