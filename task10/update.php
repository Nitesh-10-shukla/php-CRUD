<?php
session_start();
$product_name=$product_category=$product_price=$product_image="";
$product_namerr=$product_categoryerr=$product_priceerr=$product_imagerr="";
if(!empty($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $connect = mysqli_connect('localhost','root','','reg-login');
    $getData = "SELECT * FROM Products WHERE Product_id=$id";
    $result= mysqli_query($connect, $getData);
    $user = mysqli_fetch_assoc($result);
    if(isset($_POST['submit'])){
        $ids = mysqli_real_escape_string($connect, $_POST['id']);
        $product_name = mysqli_real_escape_string($connect, $_POST['pname']);
        $product_category = mysqli_real_escape_string($connect, $_POST['category']);
        $product_price = mysqli_real_escape_string($connect, $_POST['price']);
        $product_id = mysqli_real_escape_string($connect, $_POST['id']);
        if(!empty($_FILES["image"]["name"])){
            $product_image = $_FILES["image"]["name"];
        }
       elseif(!empty($_POST["oldimg"])){
        $product_image = $_POST["oldimg"];
         }
        $getData = "SELECT * FROM Products WHERE Product_id=$id";
        $result= mysqli_query($connect, $getData);
        $user = mysqli_fetch_assoc($result);
          $query ="UPDATE Products SET product_name='$product_name',product_image='$product_image',product_category='$product_category',product_price='$product_price' WHERE Product_id='$ids'";            
           $userData=mysqli_query($connect, $query);
        if(empty($product_name)){
            $product_namerr = "please enter product_name";
        }
        elseif(empty($product_category)){
            $product_categoryerr = "please enter your product_category";
        }
        elseif(empty($product_image)){
            $product_imagerr = "please enter your product_category";
        }
        elseif(empty($product_price)){
            $product_priceerr = "please enter your product_category";
        }
        else
        if($userData){
            header("location:updateproducts.php?edit='edit'");
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
    
//     if(!isset($_SESSION['username'])){
//         echo " <ul class=log>
//         <div class=errormessage><img src=error2.jpg><h1>Please login first <a href=login.php><span> Click here</span></a></h1></div>";

// }
//     else{
        ?>
         <h1>Update products-</h1>
       <div class="maindiv">
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="">Product name</label><br>
                <input type="hidden" name="id"  value="<?php echo"$id";?>">
                <input type="text" name="pname"  value="<?php echo $user['product_name']?>"><span class="errormessage" id="error"><?php echo"$product_namerr"?></span>
            </div>
            <div>
                <label for="">Category</label><br>
                <input type="text" name="category" value="<?php echo $user['product_category']; ?>"><span class="errormessage" id="error"><?php echo"$product_categoryerr"?></span>
            </div>
            <div>
                <label for="">Price</label><br>
                <input type="text" name="price" value="<?php echo $user['product_price']; ?>"><span class="errormessage" id="error"><?php echo"$product_priceerr"?></span>
            </div>
            <div>
                <label for="">image</label><br>
                <input type="hidden" name="oldimg" value="<?php echo $user['product_image'];?>">
                <input type="file"  name="image"><span class="errormessage" id="error"><?php echo"$product_imagerr"?></span>
            </div>
            <div>
                <input type="submit" class="button" value="Submit" name="submit">
            </div>
        </form>
    </div>
   
    <?php
}
else{
    echo " <ul class=log>
        <div class=errormessage><img src=error2.jpg><h1>Please login first <a href=login.php><span> Click here</span></a></h1></div>";
}
?>
</body>
</html>