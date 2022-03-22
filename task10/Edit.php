<?php
 session_start();
$userName=$userPassword="";
$nameErr=$passwordErr="";
$connect = mysqli_connect('localhost','root','','reg-login');
if(isset($_POST['submit'])){
    $userName = mysqli_real_escape_string($connect, $_POST['name']);
    $userEmail = mysqli_real_escape_string($connect, $_POST['email']);
    $userNumber = mysqli_real_escape_string($connect, $_POST['mobile']);
    $userPassword = mysqli_real_escape_string($connect, $_POST['password']);
    $getData = "SELECT * FROM registration WHERE email='$userEmail' LIMIT 1";
    $result= mysqli_query($connect, $getData);
    $user = mysqli_fetch_assoc($result);
     $id=$user['id'];
      $query ="UPDATE registration SET username='$userName',email='$userEmail',number='$userNumber',password='$userPassword' WHERE id='$id'";            
       $userData=mysqli_query($connect, $query);
    if(empty($userName)){
        $nameErr = "please enter your name";
    }
    elseif(empty($userPassword)){
        $passwordErr = "please enter your password";
    }
    elseif($userData){
       $_SESSION['email'] =  $userEmail;
       $_SESSION['username'] =  $userName;
        header("location:Home.php");
    }
    else{
        echo "failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    //   session_start();
    //   echo "<h1>{$_SESSION['username']}</h1>";
    //   echo  "<h1>{$_SESSION['email']}</h1>";
    //   echo "<h1>{$_SESSION['usernumber']}</h1>";
    //   echo "<h1>{$_SESSION['userpassword']}</h1>";
    
    if(!isset($_SESSION['username'])){
        echo " <ul class=log>
        <div class=errormessage><img src=error2.jpg><h1>Please login first <a href=login.php><span> Click here</span></a></h1></div>";

}
    else{
        ?>
       <div class=bt2>
           <a href=Home.php><button class=button2>Back</button></a>
           <a href=logout.php><button class=button2>Logout</button></a>
        </div>
       <div class="devide">
        <img src="devide.svg" class="img" alt="img">
        <form action="" name="contact-form" method="POST">
            <div>
                <label for="name">Name</label><br/>
                <input type="text" id="name" name="name" value="<?php echo $_SESSION['username']?>" required><span class="errormessage" id="error"><?php echo"$nameErr"?></span>
            </div>
            <div>
            <label for="email">Email</label><br>
            <input type="text" id="email" name="email" value="<?php echo $_SESSION['email'] ?>" readonly>
            </div>
            <div>
            <label for="mobile">Number</label><br>
            <input type="text" id="number" name="mobile" value="<?php echo $_SESSION['usernumber'] ?>" readonly>
            </div>
            <div>
            <label for="<input type="text">Password</label><br>
            <input type="text" id="passwords" name="password" value="<?php echo $_SESSION['userpassword'] ?>" required><span class="errormessage" id="Perror"><?php echo"$passwordErr"?></span>
            </div>
            <div
            <div class="btn">
            <input type="submit" class="button" name="submit" value="Submit">
            </label>
            </div>
          
        </form>
    </div>
   
    <?php
}
?>
</body>
</html>