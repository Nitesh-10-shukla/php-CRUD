<?php
// session_start();
include("admin.php");
$product_name=$product_category=$product_price=$product_image="";
$product_namerr=$product_categoryerr=$product_priceerr=$product_imagerr="";
$connect = mysqli_connect('localhost','root','','reg-login');
if(isset($_POST['submit'])){
    $product_name = mysqli_real_escape_string($connect, $_POST['pname']);
    $product_category = mysqli_real_escape_string($connect, $_POST['category']);
    $product_price = mysqli_real_escape_string($connect, $_POST['price']);
    $product_image = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];    
    $folder = "img/".$product_image;
    if(empty($product_name)){
        $product_namerr = "please enter product name";
    }
    elseif(empty($product_category)){
        $product_categoryerr = "please enter product category";
    }
    elseif(empty($product_price)){
        $product_priceerr = "please enter product price";
    }
    elseif(empty($product_image)){
        $product_imagerr = "please enter product image";
    }
    else{
      $query ="INSERT INTO Products (product_name,product_image,product_category,product_price)
                  VALUES('$product_name','$product_image','$product_category','$product_price');";
     mysqli_query($connect, $query);
     if (move_uploaded_file($tempname, $folder))  {
        header("location: updateproducts.php?edit='edit'");
    }else{
        $product_categoryerr  = "Failed to upload ";
  }
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
    if(isset($_SESSION['username'])){
        ?>
        <h1>add Products-</h1>
    <div class="maindiv">
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="">Product name</label><br>
                <input type="text" name="pname" value="<?php echo"$product_name" ?>"><span class="errormessage" id="error"><?php echo"$product_namerr"?></span>
            </div>
            <div>
                <label for="">Category</label><br>
                <input type="text" name="category" value="<?php echo"$product_category" ?>"><span class="errormessage" id="error"><?php echo"$product_categoryerr"?></span>
            </div>
            <div>
                <label for="">Price</label><br>
                <input type="text" name="price" value="<?php echo"$product_price" ?>"><span class="errormessage" id="error"><?php echo"$product_priceerr"?></span>
            </div>
            <div>
                <label for="">image</label><br>
                <input type="file"  name="image" value="<?php echo"$product_image" ?>"><span class="errormessage" id="error"><?php echo"$product_imagerr"?></span>
            </div>
            <div>
                <input type="submit" value="Submit"  class="button" name="submit">
            </div>
        </form>
    </div>
    <?php
}
else{
    header("location:login.php");
}
?>
</body>
</html>