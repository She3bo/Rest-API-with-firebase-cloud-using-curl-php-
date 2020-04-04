<?php
    require_once("APIFunctions.php");
    $obj = new APIFunctions();
    error_reporting(E_ERROR | E_PARSE);
    $response = (array)$obj->get("users.json");
    //var_dump((array)$response);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Api Assignment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container pt-4">
        <a href="CreateUser.php" class="btn btn-success float-right mb-2">Add User</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $x=1; 
                foreach($response as $obj){
                    $id=array_search ($obj, $response);
                    $address = "APIFunctions.php?delete=".$id;
                    //echo $address;
                    ?>
                    <tr>
                        <th scope="row"><?=$x++?></th>
                        <td><?=$obj->name?></td>
                        <td><?=$obj->age?></td>
                        <td><?=$obj->email?></td>
                        <form action=<?=$address?> method="post" >
                            <input type="hidden" name="delete">
                            <td><button class="btn btn-danger">delete</button></td>
                        </form>
                    </tr>
                <?php }?>
            </tbody>
        </table>

            
    </div>
</body>
</html>