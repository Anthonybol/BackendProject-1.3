<!DOCTYPE html>
<html>
<head>
    <title>	</title>
    <link rel="stylesheet" href="../css/item_processing.css"><!--  Link to CSS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">
</head>
<body>

<?php
ob_start();
session_start();
require_once('../mysql.php');

if(isset($_POST['submit'])) {
    echo "here";

}
//Clear cart. 
if(isset($_POST['Reset'])) {


    $sql = "DELETE FROM orderline WHERE OrderID = " . $_SESSION['order_id_num']; 
    $sql = "DELETE FROM orders WHERE OrderID = " . $_SESSION['order_id_num'];
    $data = mysqli_query($conn, $sql) or die("Bad SQL: $sql");
    unset($_SESSION['order_id_num']);
    header( "location: members.php" );

}

// Delete from cart 1 by 1.
if(isset($_POST['Delete'])) {
    $productId = $_POST['productId'];
    $orderId = $_POST['orderId'];

    $sql = "DELETE FROM orderline WHERE ProductID = '$productId' AND OrderID={$orderId}";
    $data = mysqli_query($conn, $sql) or die("Bad SQL: $sql");
    header( "location: items.php" );

}

if(isset($_POST['Update'])) {
    foreach($_POST['quantity_items_'] as $key => $value) {
        echo "text $key = $value";


      $orderLineUpdate = "UPDATE orderline SET OrderQuantity = '$value' WHERE OrderId={$_POST['orderId']} AND ProductId='{$_POST['productId']}';";
     $data = mysqli_query($conn, $orderLineUpdate) or die(mysqli_error($conn));
     header( "location: items.php" );
    }
}
//------------------------------------------------------------------------------------------------------



if(isset($_POST['Confirm'])) {

    $date = date("Y-m-d");
    $customer_id = $_SESSION['customer_id'];
    $userId = $_SESSION['user_id'];
    $customer_id = intval($customer_id);
    unset($_SESSION['order_id_num']);
    // $quantity = $_SESSION['quant']; 
    //  $quantity = $_POST['quantity_items_'];

    $loop = 0;

    //  $orderLineUpdate = "UPDATE orderline SET OrderQuantity = '$quantity';";
    //  $data = mysqli_query($conn, $orderLineUpdate) or die(mysqli_error($conn));

    //Cusotmer details (no issues)
    $sql = "SELECT * FROM customer WHERE CustomerID = '$customer_id'";
    $data = mysqli_query($conn, $sql) or die("Bad SQL: $sql");
}
    while($row = mysqli_fetch_array($data)) {
        $customer_name = $row['CustomerGivenName'];
        $address = $row['CustomerAddress'];
        $subUrb = $row['CustomerSuburb'];
        $state = $row['CustomerState'];
        $postalCode = $row['CustomerPostCode'];

    }
    ?>

        <div class="order-form"><h1>  Complete Order</h1></div>
        <div class="main">
    <form action="item_processing.php" method="post">
    <div id="name">
    <h2 class="name">Name</h2>
        <input type="text" class="member-name" name="name" value="<?php echo $customer_name?>"><br>
        
    <h2 class="name">Address</h2>
        <input type="text" class="address" name="address" value="<?php echo $address?> ">
        
    <h2 class="name">Suburb</h2>
        <input type="text" class="suburb" name="suburb" value="<?php echo $subUrb?>">
        
    <h2 class="name">State</h2>
        <input type="text" class="state" name="state" value="<?php echo $state?>">
        
    <h2 class="name">Postal Code</h2>
        <input type="text" class="postal-code" name="postalCode" value="<?php echo $postalCode?>">

</div>
<?php


$sql = "select orl.OrderID,p.ProductGlazeTypeCode, p.ProductDescription, p.ProductPrice, orl.OrderQuantity, orl.ProductID from product p 
INNER JOIN orderline orl on orl.ProductID = p.ProductID 
INNER JOIN orders ord on ord.OrderID = orl.OrderID where ord.CustomerID = '$customer_id'";

$data = mysqli_query($conn, $sql) or die("Bad SQL: $sql");
if (mysqli_num_rows($data)) { //$data is the result. In this case, there is 1 row.
    $out = "Success"; //mysqli_num_rows is checking if data is present in database. Also returning number of rows present.
}
$totalRow= mysqli_num_rows($data);
    $total = 0;
    if($totalRow == 0){
       $total = 0;
    }
    while($row = mysqli_fetch_array($data)) {
        $total += $row['OrderQuantity']*$row['ProductPrice'];
        $product_id = $row['ProductID'];
        $order_quantity = $row['OrderQuantity'];
        $order_id = $row['OrderID'];
        if($row['OrderQuantity'] == 0)
        continue;

?>

<table><!--  Order form  -->
<tr>
        <th id="product-th">Product Code</th>
        <th id="quantity-th">Quantity</th>
        <th id="unit-th">Unit Price</th>
        <th id="order-th">Order ID</th>
        <th id="date-th">Date</th>
   </tr>
<tr>

        <td>
        <div class="cart-info">
        <div class="product-code"> 
        <input type="text" id="product-code" name="productCode" value="<?php echo $row['ProductID']?>" readonly>
        </div>
        </td>

        <div class="quantity">
        <td>
        <input type="text" id="quantity" name="quantity" value="<?php echo $row['OrderQuantity']?>">
        </td>
        </div>
        <div class="price">
        <td>
        <input type="text" id="price" name="price" value="<?php echo $row['ProductPrice']?>" readonly>
        </td>
        </div>
        <div class="order-id">
        <td>
        <input type="text" id="order-id" name="orderId" value="<?php echo $row['OrderID']?>" readonly> 
        </td>
        </div>
        <div class="date">
        <td>
        <input type="text" id="date" name="date" value="<?php echo $date?>" readonly> 
        </td>
        </div>
        </tr>
        </table>

        <?php
        $loop++;
    }?>
    </form>

    <div class="total-price">
<table>
<tr>
        <td>Subtotal</td>
    <td><a target="_blank">$<?php echo $total?>.00</a></td>
</tr>
<tr>
        <td>Tax</td>
    <td>$0.00</td>
</tr>
    <tr>
        <td>Total</td>
    <td><a target="_blank">$<?php echo $total?>.00</a></td>
</tr>
</table>
</div>

<?php

if(isset($_SESSION['order_id_num']) && $_SESSION['order_id_num'] == 1) {
    echo 'error, session is set';
} else if(!isset($_SESSION['order_id_num']) || (isset($_SESION['order_id_num']) && $_SESSION['order_id_num'] == 0)){
    $sql = "DELETE FROM orderline;"; 
    $data = mysqli_query($conn, $sql) or die("Bad SQL: $sql");
}

?>
<div class="payement-button">
<input type="button" name="payment" id="payement" value="Payment" onclick="window.opener.location.reload(true); window.close(); return false;">
</div>
</div>
<?php include("../shared/footer.inc");?>

    </body>
</html>