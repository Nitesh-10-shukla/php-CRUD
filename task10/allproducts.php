<?php
session_start();
$connect = mysqli_connect('localhost','root','','reg-login');
$getData = "SELECT * FROM Products ORDER BY product_category DESC ";
$result= mysqli_query($connect, $getData);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>allproducts</title>
</head>
<style>
     table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }
        h1 {
            text-align: center;
            color: #006600;
            font-size:large;
        }

table td,th {
text-align:center;
padding: 20px 40px;  
}
tr:nth-child(odd) {
background-color: #b5e7e9;
}
tr:nth-child(even):hover{
background-color: #35ebf1;
}
th{
background-color:#2C2C2B;
color: #fff;
}
</style>
<body>
    <?php 
    if(isset($_SESSION['username'])){
        ?>
<section>
        <h1>All user</h1>
        <table>
            <tr>
                <th>UserName</th>
                <th>UserEmail</th>
                <th>UserNumber</th>
                <th>UserPassword</th>
            </tr>
            <?php  
            while($user = mysqli_fetch_assoc($result)){
             ?>
            <tr>
                <td><?php echo $user['product_name'];?></td>
                <td><img src="<?php echo $user['product_image'];?>"></td>
                <td><?php echo $user['product_category'];?></td>
                <td><?php echo $user['product_price'];?></td>
            </tr>
            <?php
                }
             ?>
        </table>
    </section> 
    <?php
    }else{
        header("location:login.php");
    } 
    ?>
</body>
</html>