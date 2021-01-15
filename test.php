<?php
    require_once('db.php'); 
    require_once 'employee.php';


    $employee = new Employee('aaa', 'aaa', 'aa@aa.com', 23, 7000, 2.3);
    
    $result = $employee::getByPk(14);
    $result->setFirsName('zakaria');
    $result->update();
    

?>

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

                    <?php if(is_array($result) && !empty($result)){foreach($result as $res){?>

                        <tr>
                            <td><?= $res->Id ?></td>
                            <td><?= $res->FirstName ?></td>
                            <td><?= $res->LastName ?></td>
                            <td><?= $res->Email ?></td>
                            <td><?= $res->Age ?></td>
                            <td><?= $res->calculateSalary()?> DH</td>
                            <td><?= $res->Tax ?></td>
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
                        </tr>
                        <?php
                    }else{
                        echo "<td colspan='7'>We Haven't Any Data To Desplay !</td>";
                    }?>
                    
                </tbody>
            </table>
    