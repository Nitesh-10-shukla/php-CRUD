<?php
session_start();
$userName=$userEmail=$userNumber=$userPassword=$userConfirmPassword="";
$nameErr=$numberErr=$emailErr=$passwordErr=$cpasswordErr="";
$connect = mysqli_connect('localhost','root','','reg-login');
if(isset($_POST['submit'])){
    $userName = mysqli_real_escape_string($connect, $_POST['name']);
    $userEmail = mysqli_real_escape_string($connect, $_POST['email']);
    $userNumber = mysqli_real_escape_string($connect, $_POST['mobile']);
    $userPassword = mysqli_real_escape_string($connect, $_POST['password']);
    $userConfirmPassword = mysqli_real_escape_string($connect, $_POST['cpassword']);
    $getData = "SELECT * FROM registration WHERE email='$userEmail' LIMIT 1";
    $result= mysqli_query($connect, $getData);
    $user = mysqli_fetch_assoc($result);
    if(empty($userName)){
        $nameErr = "please enter your name";
    }
    elseif(empty($userEmail)){
        $emailErr = "please enter your email";
    }
    elseif(empty($userNumber)){
        $numberErr = "please enter your number";
    }
    elseif(empty($userPassword)){
        $passwordErr = "please enter your password";
    }
    elseif(empty($userConfirmPassword) || $userConfirmPassword != $userPassword){
        $cpasswordErr = "password does't match";
    }
    elseif(!empty($user['email'])===!empty($userEmail)){
        $emailErr = "Email already exist";
    }
    else{
      $query ="INSERT INTO registration (username,email,number,password)
                  VALUES('$userName','$userEmail','$userNumber','$userPassword');";
     mysqli_query($connect, $query);
     header("location:login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php task-8</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .inflex {
        display: flex;
        justify-content: space-around;
        align-items:center;
    }
    ul{
        display: flex;
       gap:40px;
    }
    li{
        list-style:none;
        border:1px solid gray;
        padding: 10px 25px;
        text-align:center;
        color:black;
    }
    li:hover{
        background:blue;
        border:none;
    }
    a{
    text-decoration:none;
  
}
h3{
    font-size:35px;
    text-shadow: 2px 2px 4px #000000
}
</style>
<body>
<div class="inflex">
        <h3>Home</h3>
        <ul>
            <a href="registration.php"><li>Register</li></a>
            <a href="login.php"><li>Login</li></a>
        </ul></div>
    <div class="devide2">
        <img src="devide.svg" class="img2" alt="img">
        <form action="" name="contact-form" method="POST">
            <div>
                <label for="name">Name</label><br/>
                <input type="text" id="name" name="name" value="<?php echo"$userName"?>"><span class="errormessagee" id="error"><?php echo"$nameErr"?></span>
            </div>
            <div>
            <label for="email">Email</label><br>
            <input type="text" id="email" name="email" value="<?php echo"$userEmail"?>"><span class="errormessagee" id="Eerror"><?php echo"$emailErr"?></span>
            </div>
            <div>
            <label for="mobile">Number</label><br>
            <input type="text" id="number" name="mobile" value="<?php echo"$userNumber"?>"><span class="errormessagee" id="Nerror"><?php echo"$numberErr"?></span>
            </div>
            <div>
            <label for="<input type="text">Password</label><br>
            <input type="text" id="passwords" name="password" value="<?php echo"$userPassword"?>"><span class="errormessagee" id="Perror"><?php echo"$passwordErr"?></span>
            </div>
            <div>
            <label for="cpassword">Confirm password</label><br>
            <input type="text" id="cpasswords" name="cpassword" value="<?php echo"$userConfirmPassword"?>"><span class="errormessagee" id="Cerror"><?php echo"$cpasswordErr"?></span>
            </div>
            <p>Already registered <a href="login.php"><span>Login</span></a></p>
            <div class="btn">
            <input type="submit" id="button" name="submit" value="Submit">
            </label>
            </div>
          
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
        $('form[name="contact-form"]').submit(function(event){
        var message;
        var myEmailValidation = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var username =  $("#name").val();
        var myEmail = $("#email").val();
        var myNumber = $("#number").val();
        var myPassword = $("#passwords").val();
        var RePassword = $("#cpasswords").val();
       if(username.trim() == ""){
        $("#error").html(message="Please enter your name")
        return false
       }
       else{
        $("#error").html(message="")
       }
       if(myEmail.trim() == ""){
        $("#Eerror").html(message="Please Enter your email")
        return false
       }
       else if(!myEmail.match(myEmailValidation)){
           $("#Eerror").html(message="Please Enter valid email");
           return false;
       }
       else{
        $("#Eerror").html(message="");
       }
       if(myNumber.trim() == ""){
        $("#Nerror").html(message="Please Enter your number")
        return false
       }
       else if(myNumber.length ==10){
           $("#Nerror").html(message="");
       }
       else{
        $("#Nerror").html(message="Please Enter valid number");
        return false;
       }
       if(myPassword.trim() == "") {
       $("#Perror").html(message="Please Enter your password");
       return false;
         }
      else if(myPassword.length <6 ) {
         $("#Perror").html(message="Please Enter atleast 6 digits")
         return false;
        }
         else{
            $("#Perror").html(message="");
         }
        if(RePassword === myPassword) { $("#Cerror").html(message="") } 
      else{
        $("#Cerror").html(message="Password didn't match")
        return false
    }     
    });

</script>

</body>
</html>