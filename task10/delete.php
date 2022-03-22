<?php
 $connect = mysqli_connect('localhost','root','','reg-login');
 if(!empty($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $query = "DELETE FROM Products WHERE Product_id=$id"; 
    $result = mysqli_query($connect,$query) or die ( mysqli_error());
    header("location: updateproducts.php?delete='delete'");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>

    </div>
</body>
</html>