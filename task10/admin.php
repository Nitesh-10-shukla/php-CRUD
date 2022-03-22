<?php
session_start();
// echo $_SESSION['username'];
// if(empty($_SESSION['username'])){
// $_SESSION['username'] = "admin";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<style>
    .adminbtn{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin:10px 50px;
}
.adminuser{
    border:none;
    display: flex;
    font-size:30px;
    font-weight:700;
    gap:10px;
    align-items:center;
}
</style>
<?php

if($_SESSION['email'] == 'admin@admin.com'){
    ?>
   <div class=adminbtn>
       <ul>
   <li class=adminuser><img src=usernew.png style=height:50px>ADMIN</li></ul>
     <div><a href="Home.php"><button class="adminlog">Home</button></a>&nbsp; &nbsp; &nbsp;<a href="logout.php"><button class="adminlog">Logout</button></a></div></div>
    <div class="admindiv">
       <a href="addproduct.php"><button class="adminbutton">Add Product</button></a> 
      <a href="updateproducts.php?edit='Edit'"><button class="adminbutton"> Update Product</button></a>  
      <a href="updateproducts.php?delete='Delete'">  <button class="adminbutton">Delete Product</button></a>
       <a href="registerduser.php"><button class="adminbutton">View Registered Users</button></a> 
    </div>
    <?php
}
elseif(isset($_SESSION['username'])){
    header("location:Home.php");
}
else{
    header("location:login.php");
}
?>
</body>
</html>