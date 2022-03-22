<?php
include("admin.php");
$connect = mysqli_connect('localhost','root','','reg-login');
$getData = "SELECT * FROM Products ORDER BY product_category DESC ";
$result= mysqli_query($connect, $getData);
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
text-transform:uppercase;
}
td{
    text-transform:capitalize;
}
img{
    width: 100px;
    height: 100px;
    border-radius: 50px;
    object-fit: cover;
}
button{
    padding: 10px 20px;
    border: none;
    margin: 10px 2px;
    background-color: rgba(250, 59, 25, 0.1);
    backdrop-filter: blur(30px);
    color: #000;
    font-size: 14px;
    letter-spacing: 2px;
    cursor: pointer;
}
button:hover{
    background-color: rgba(255,255,255,0.2);
    border: 2px solid rgb(243, 66, 34);
    color: #000;
}
</style>
<body>
    <?php 
    if(isset($_SESSION['username'])){
        
        ?>
<section>
        <h1>All products</h1>
        <table>
            <tr>
                <th>product_name</th>
                <th>product_image</th>
                <th>product_category</th>
                <th>product_price</th>
                <th>Action</th>
            </tr>
            <?php  
            while($user = mysqli_fetch_assoc($result)){
             ?>
            <tr>
                <td><?php echo $user['product_name'];?></td>
                <td><img src="img/<?php echo $user['product_image'];?>"></td>
                <td><?php echo $user['product_category'];?></td>
                <td><?php echo $user['product_price'];?></td>
                <td>
                  <?php
                  if(!empty($_REQUEST['edit'])){
                  ?>
               <a href="update.php?id=<?php echo $user['Product_id']; ?>"><button>Edit</button></a> 
                <?php } elseif(!empty($_REQUEST['delete'])){  
                ?>
<a href="delete.php?id=<?php echo $user['Product_id']; ?>"><button>Delete</button></a>
            <?php } ?>
            </td>
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