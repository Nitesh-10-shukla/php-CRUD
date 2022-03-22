<?php
session_start();
$useremail=$userpassword="";
$emailerr=$passworderr="";
$connect = mysqli_connect('localhost','root','','reg-login');
if(isset($_POST['submit'])){
    $useremail = mysqli_real_escape_string($connect, $_POST['useremail']);
    $userpassword = mysqli_real_escape_string($connect, $_POST['userpassword']);
    $query = "SELECT * FROM registration WHERE email='$useremail' AND password='$userpassword'";
    $data = mysqli_query($connect, $query);
     $userData = mysqli_fetch_assoc($data);
    if(empty($useremail)){
        $emailerr = "please enter your email";
    }
    elseif(empty($userpassword)){
        $passworderr = "please enter your password";
    }
    else{
    if(mysqli_num_rows($data) == 1) {  
        $_SESSION['email'] = $useremail;
        $_SESSION['username'] = $userData['username'];
        $_SESSION['usernumber'] = $userData['number'];
        $_SESSION['userpassword'] = $userData['password'];
        $_SESSION['ID'] = $userData['id'];
        if($userData['email'] === 'admin@admin.com'){
            header('location: admin.php');
         }
         else {
            header('location: Home.php');
         }
  	}else {
        $emailerr = "invalid email or password";
  	}}
    
}
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
li{
    color:black;
}
</style>
</style>
<body>
<div class="inflex">
        <h3>Home</h3>
        <ul>
            <a href="registration.php"><li>Register</li></a>
            <a href="login.php"><li>Login</li></a>
        </ul></div>
   <div class="loginform">
       <form action="" method="POST" onsubmit="return loginUser()">
           <div><label for="email" >Email</label><br><input type="text" name="useremail" id="useremail" value="<?php echo"$useremail"?>"><br><span class="errormessage" id="eerror"><?php echo"$emailerr"?></span></div>
           <div><label for="password" >Password</label><br><input type="text" name="userpassword" id="userpassword"value="<?php echo"$userpassword"?>"><br><span class="errormessage" id="perror"><?php echo"$passworderr"?></span></div>
           <div class="btn"><input type="submit" id="button" name="submit"></div>
           <p>Don't have account <a href="registration.php"><span>Register</span></a></p>
       </form>
   </div>
   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
     <script>
         var message;
         function loginUser(){
            var myEmailValidation = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var userpassword =  $("#userpassword").val();
            var myEmail = $("#useremail").val();

       if(myEmail.trim() == ""){
       $("#eerror").html(message="Please Enter your email")
        return false
       }
       else if(!myEmail.match(myEmailValidation)){
           $("#eerror").html(message="Please Enter valid email");
           return false;
       }
       else{
        $("#eerror").html(message="");
       }
       if(userpassword.trim() == ""){
        $("#perror").html(message="Please Enter your password")
        return false
       }
       else{
        $("#perror").html(message="");
       }
         }
     </script>
</body>
</html>