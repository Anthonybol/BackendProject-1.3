<?php
ob_start();
?>
<?php 
session_start()
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="../css/members_order.css"><!--  Link to CSS-->
</head>

<body class="body">

<?php include("../shared/banner.inc"); ?>
<?php include("../shared/nav.inc");?>
<?php if( isset($_SESSION['user_name']) && !empty($_SESSION['user_name']) ){
}
?>
<!-- <div class="nav_bar_index">
<ul>
      <li><a href="../index.php">Home</a></li>
      <li><a href="members.php">Members</a></li>
      <li><a href="production.php">Production</a></li>
      <li><a href="companybackground.php">Background</a></li>
      <li style="position: absolute; right: 20px;"><a href="logout.php">Logout</a></li>

</ul>
</div> -->

<div class="username_intro">      
<br><br>
    Hello,<strong style="color: red"> 
<?php

//Grabbing username of user
if( isset($_SESSION['user_name']) )//Displaying greeting/username if user is logged in. 
{
echo $_SESSION['user_name'];//echo username of user 
}?> 
<!-- Hey 'username' welcome to our site -->
</strong>
please add to your cart. 
<br><br>
</div>
   <!-- Image table class -->
  <div class="div_table">
  <table  id="imageTable" cellspacing="0" cellpadding="0">
  </table>
  </div>

  <div id="product-label" class="product-label">
    </div>
    
  <?php
  require_once('../mysql.php');

//PHP code for ORDER FORM

$error = "";
if(isset($_POST['cart'])) {
    $name =  $_POST['itemDescription'];
    $quantity =  $_POST['thisQty'];
    $OrderID = "OrderId";
    $date = date("Y-m-d");
    $customerId = $_SESSION['customer_id'];
    // $OrderID = $_SESSION['order_id_num'];
    $productId = "";

    $sql = "SELECT * FROM product WHERE ProductID = '$name'";
    $data = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if (mysqli_num_rows($data) >0) {
 echo '<script language="javascript">'; 
        echo 'alert("Item has already been added to cart! Please adjust the quantity in your cart.")';
        echo '</script>';
        echo "<script type='text/javascript'>  window.location='http://bazaarceramics.anthonyjames.com.au/php/members.php'; </script>";
    }
    else {
        $error = "No product found";
    }

    if($error == ""){
        while ($row = $data->fetch_assoc()) {
            $productId = $row['ProductID'];
        }
    
    if(isset($_SESSION['order_id_num'])){
	
         echo "Favorite color is " . $_SESSION["order_id_num"] . ".<br>";
        $OrderID = "SELECT OrderID FROM orders ORDER BY OrderID DESC LIMIT 1;";
        $data= mysqli_query($conn, $OrderID) or die(mysqli_error($conn));
        while($row = $data->fetch_assoc()) {
        $OrderID = $row['OrderID'];

        $orderLineInsert = "INSERT INTO orderline (OrderID,ProductID,OrderQuantity) VALUES ( '$OrderID' ,'$productId' ,'$quantity');";
        $data = mysqli_query($conn, $orderLineInsert) or die(mysqli_error($conn));

        header("Location: members.php");
            }
    }
        
        else{
            
                $orderInsert = "INSERT INTO orders (OrderID, CustomerID, OrderDate) VALUES ('$OrderID', '$customerId', '$date')";
                $data = mysqli_query($conn, $orderInsert);
                $OrderID = "SELECT OrderID FROM orders ORDER BY OrderID  DESC LIMIT 1;";
                $data= mysqli_query($conn, $OrderID) or die(mysqli_error($conn));
                while
                ($row = $data->fetch_assoc()) {
                $OrderID = $row['OrderID'];
                
        
                $orderLineInsert = "INSERT INTO orderline (OrderID,ProductID,OrderQuantity) VALUES ('$OrderID' ,'$productId' ,'$quantity');";
                $data = mysqli_query($conn, $orderLineInsert) or die(mysqli_error($conn));

                $_SESSION['order_id_num'] = $OrderID;

                header("Location: members.php");
        
        }
        }
        }
        }

?>

<div class ="form-container">
     <div class="order-form">
            <form action="members_order.php" class="orderForm" id="orderForm" name="orderForm" method="post" onsubmit="return validateForm();"> <!-- alidate form for errors -->
                <!--  Order form  -->
                <div id="name">

                <h3 class="name">Item Description</h3>
                <input name="itemDescription" class="item-description" id="itemDescription" type="text" readonly/>

                <h3 class="name">Quantity:</h3>
                <input type="number" value="1" class="quantity" name="thisQty" id="thisQty"  onChange="calculateOrder()"/>
    
                <h3 class="name">Price:</h3>
                <div id="priceDiv" >
                  <input type="number" class="price" name="price" id="price" onChange="calculateOrder()" readonly/>
                </div>

                <h3 class="name">Total Price:</h3>
                <div id="totalPriceDiv"> 
                <input type="number" class="total-price" name="totalPrice" id="totalPrice"  readonly/>
                </div>
                </div>

                <text style="color: red"><?php echo $error ?></text>
                <div class="submit-button">
                 <input type="submit" name="cart" id="cart" value="Add to Cart"  onclick="return AddToCart()"/>
                </div>                          
            </form>
        </div>
    </div>
  <script type="text/javascript" src="../javascript/members_order.js"></script>
  <?php include("../shared/footer.inc");?>

</body>
</html>