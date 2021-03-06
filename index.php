<?php 

    session_start();

    require_once('db.php');
    require_once('employee.php');

    // SUBMIT =>  UPDATE & CREATE EMPLOYEE
    if(isset($_POST['submit'])){

        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
        $salary = filter_input(INPUT_POST, 'salary', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $tax = filter_input(INPUT_POST, 'tax', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $employee = new Employee($firstname, $lastname, $email, $age, $salary, $tax);

        if(isset($_GET['action']) && $_GET['action'] == 'edit'){
            
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            if($id > 0){
                
                $saved = $employee::getByPk($id);
                // USE GETTERS TO UPDATE THE EMPLOYEE
                $saved->setFirsName($firstname);
                $saved->setLastName($lastname);
                $saved->setEmail($email);
                $saved->setAge($age);
                $saved->setSalary($salary);
                $saved->setTax($tax);

                $saved->save();
            }
            
        }else{
            
            $saved = $employee->save();                                        
        }

        if($saved){
            $_SESSION['message'] = "$firstname Saved successfully";
            $_SESSION['success'] = true;
            
        }else{
            $_SESSION['message'] = "$firstname Encountre some Issues";
            $_SESSION['success'] = false;
        }

         header('Location: index.php');
            exit(); 

    }

    // GET THE DATA OF A SPECIFI EMPLOYEE TO UPDATE IT
    if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if($id > 0){
            $employee = new Employee(null, null, null, null, null, null);
            $user = $employee::getByPk($id);
        }
        
        unset($_SESSION['message']);
    }

    // DELETE THE EMPLOYEE
    if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if($id > 0){
            $employee = new Employee(null, null, null, null, null, null);
            $deleted = $employee::getByPk($id)->delete();
            unset($employee);
            if($deleted){
                $_SESSION['message'] = "Employee Deleted successfully";
                $_SESSION['success'] = true;
            }
                              
        }
        
    }


    /* $result = $stat->fetchAll(PDO::FETCH_BOTH); */
    /* $result = $stat->fetchAll(PDO::FETCH_ASSOC); */
    /* $result = $stat->fetchAll(PDO::FETCH_OBJ); */

    $employee = new Employee(null, null, null, null, null, null);
    $result = $employee::getAll();


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
                     <?php if(isset($_SESSION['message'])){?>
                             <p class="message<?= $_SESSION['success'] ? ' success': ' failed'?>"> <?= $_SESSION['message']?> </p> 
                        <?php unset($_SESSION['message']);} ?>
                     
                    <div class="form-group">
                        <label for="firstname">firstname:</label>
                        <input type="text" id="firstname" name="firstname" required value="<?= isset($user) ? $user->FirstName : ''?>">
                    </div>
                    

                    <div class="form-group">
                        <label for="lastname">lastname:</label>
                        <input type="text" id="lastname" name="lastname" required value="<?= isset($user) ? $user->LastName : ''?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">email:</label>
                        <input type="text" id="email" name="email" required value="<?= isset($user) ? $user->Email : ''?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="age">age:</label>
                        <input type="number" id="age" name="age" required min="20" max="75" value="<?= isset($user) ? $user->Age : ''?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="salary">salary:</label>
                        <input type="number" id="salary" name="salary" required min="2000" max="10000" step="25" value="<?= isset($user) ? $user->Salary : ''?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="tax">tax:</label>
                        <input type="number" id="tax" name="tax" required min="1" max="5" step='.1' value="<?= isset($user) ? $user->Tax : ''?>">
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

                    <?php if(is_array($result) && !empty($result)){foreach($result as $res){?>

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
                                <a href='index.php ?action=delete&id=<?= $res->Id?>' onclick="if(!confirm('You Want  To Delete <?= $res->FirstName?>')){ return false; } "><i class='fas fa-trash'></i></a>
                            </td>
                        </tr>

                        <?php
                        }
                    }elseif(is_object($result)){
                        ?>
                            <tr>
                            <td><?= $result->Id ?></td>
                            <td><?= $result->FirstName ?></td>
                            <td><?= $result->LastName ?></td>
                            <td><?= $result->Email ?></td>
                            <td><?= $result->Age ?></td>
                            <td><?= $result->calculateSalary()?> DH</td>
                            <td><?= $result->Tax ?></td>
                            <td>
                                <a href='index.php?action=edit&id=<?= $result->Id?>'><i class="fas fa-edit"></i></a>
                                <a href='index.php ?action=delete&id=<?= $result->Id?>' onclick="if(!confirm('You Want  To Delete <?= $res->FirstName?>')){ return false; } "><i class='fas fa-trash'></i></a>
                            </td>
                        </tr>
                        <?php
                    }else{
                        echo "<td colspan='7'>We Haven't Any Data To Desplay !</td>";
                    }?>
                    
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>