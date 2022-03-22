<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="newstyle.css">
</head>
<style>
  body{
    background-image:url(home.jpg);
    height: 600px;
    background-position: center;
    background-repeat: no-repeat;
    color:white;
    background-size: cover;
    object-fit: cover;
    }
</style>
<body>
    <div>

    <?php
if(isset($_SESSION['username'])){
    if($_SESSION['email'] == 'admin@admin.com'){
        $_SESSION['username'] = "admin";
        echo "<div class=dash><a href=admin.php><button class=dashbtn>Dashboard</button></a></div>";
    }
    echo " <ul class=log>
    <li class=user><img src=usernew.png style=height:50px>{$_SESSION['username']}</li><a href=logout.php  ><li class=logout>Logout</li></a> </ul>";
    // echo "<div class=edit><a href=user_allproducts.php><button>View all products</button></a></div>";
    // echo  "<h1>{$_SESSION['email']}</h1>";
     echo "<h1>Hello  {$_SESSION['username']}</h1>";
    echo "<div class=homemain><div class=edit><a href=user_allproducts.php><button>View all products</button></a></div><div class=edit><a href=Edit.php ><button>Edit Profile</button></a></div></div>";
}
else{
?>
<div class="inflex">
        <h3>Home</h3>
        <ul>
            <a href="registration.php"><li>Register</li></a>
            <a href="login.php"><li>Login</li></a>
        </ul>
    </div>
<h1>Hello User</h1>
<?php
}
?>
    </div>
</body>
</html>