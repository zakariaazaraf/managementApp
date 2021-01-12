<?php 

    require_once('db.php');
    require_once('employee.php');

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
                    <tr>
                        <td>1</td>
                        <td>aaaaaa</td>
                        <td>aaaaaa</td>
                        <td>aaaaa@gmail.com</td>
                        <td>22</td>
                        <td>7000</td>
                        <td>1.5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>aaaaaa</td>
                        <td>aaaaaa</td>
                        <td>aaaaa@gmail.com</td>
                        <td>22</td>
                        <td>7000</td>
                        <td>1.5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>aaaaaa</td>
                        <td>aaaaaa</td>
                        <td>aaaaa@gmail.com</td>
                        <td>22</td>
                        <td>7000</td>
                        <td>1.5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>aaaaaa</td>
                        <td>aaaaaa</td>
                        <td>aaaaa@gmail.com</td>
                        <td>22</td>
                        <td>7000</td>
                        <td>1.5</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>