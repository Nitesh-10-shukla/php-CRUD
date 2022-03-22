<?php
session_start();
$connect = mysqli_connect("localhost","root","","reg-login");
$display_query = "SELECT * FROM `Products` GROUP BY product_category";
$Product_result = mysqli_query($connect,$display_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .main{
        margin:50px;
    }
    .row{
        display: flex;
        justify-content: space-around;
        gap:10px;
        margin: 10px;
    }
    .column{
        width: 100%;
        padding: 15px;
        background:#fff;
        padding:15px;
         box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        filter: drop-shadow(0px 0px 7px rgba(1, 1, 1, .7));
    }
    .column:hover{
        transform: translateY(-5px) scale(1.005) translateZ(0);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .column2{
        display: flex;
        justify-content: space-between;
    }
    img{
        width: 100%;
        height: 200px;
        object-fit:cover;
    }
    .category{
        text-align:start;
        margin:0 20px;
        text-transform:capitalize;
    }
    .homebtn{
        text-align:center;
    }
   .homebtn button {
    background-color:blue;
    color: #fff;
    padding: 15px 30px;
    cursor: pointer;
    border:none;
   }
</style>
<body>
<?php 
    if(isset($_SESSION['username'])){
        ?>
    <div class="main">
        <div class="homebtn">
        <a href="Home.php"><button >Back</button></a></div>
    <?php  
        while($products = mysqli_fetch_assoc($Product_result)){
            $Product_Caregory=$products['product_category'];
            echo "<h1 class=category> $Product_Caregory </h1>.<br>";
           if($Product_Caregory){
            $products_query = "SELECT * FROM `Products` WHERE product_category='$Product_Caregory'";
            $Product_result2 = mysqli_query($connect,$products_query);
        ?>
         <div class="row">
        <?php
            while($products2 =mysqli_fetch_assoc($Product_result2)){
                ?>
                 <div class="column">
                 <img src="img/<?php echo $products2['product_image'];?>">
                 <div class="column2">
                     <p>Name: <?php echo $products2['product_name'];?></p>
                     <p>Price: <?php echo $products2['product_price'];?></p>
            </div>
                 </div>
                 
                <?php
            }
            
            ?>
            </div>
            <?php
            echo "<br>";
           }
        }
             ?>
    
    </div>
    <?php
    }else{
        header("location:login.php");
    } 
    ?>
</body>
</html>