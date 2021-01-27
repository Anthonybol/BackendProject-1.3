<?php
ob_start();
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(!isset($_SESSION['user_name'])){ 
    echo "<script>
        alert('Please login');
        window.location.href='javascript:history.go(-1)'; 
        </script>"; 
    exit;
}
?>

<html>
<head> 
<link rel="stylesheet" href="../css/items.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">
</head>
<body>

<?php
require_once('../mysql.php');
$userId = $_SESSION['user_id'];
$customer_id = $_SESSION['customer_id'];

$customer_id = intval($customer_id);


$sql = "select orl.OrderID,p.ProductGlazeTypeCode, p.ProductDescription, p.ProductPrice, orl.OrderQuantity, orl.ProductID from product p 
INNER JOIN orderline orl on orl.ProductID = p.ProductID 
INNER JOIN orders ord on ord.OrderID = orl.OrderID where ord.CustomerID = '$customer_id'";
$data = mysqli_query($conn, $sql) or die("Bad SQL: $sql");
if (mysqli_num_rows($data)) { //$data is the result. In this case, there is 1 row.
    $out = "Success"; //mysqli_num_rows is checking if data is present in database. Also returning number of rows present.
    
}else{
//    echo "Not able to fetch data from database";
}
$loop = 0;

$totalRow= mysqli_num_rows($data);

if($totalRow == 0){
    echo '<script language="javascript">';
    echo 'alert("Please add to your shopping cart")';
    echo '</script>';
    echo "<script type='text/javascript'>  window.location='members.php'; </script>";
}

while($row = mysqli_fetch_array($data)) {
    $total = $row['OrderQuantity']*$row['ProductPrice'];
    $productId = $row['ProductID'];
    $productQty = $row['OrderQuantity'];
    if($row['OrderQuantity'] == 0)
        continue;

?>

<div class="form_wrapper">
<form action="item_processing.php" method="post">

<table>

    <tr>
        <th id="product-th">Product</th>
        <th id="quantity-th">Quantity</th>
        <th id="unit-th">Unit Price</th>
   </tr>

   <tr>
       <td>
        <div class="cart-info">
        <div class="product-code">          
        <input type="text" id="product-code" name="productCode" value="<?php echo $row['ProductID']?>" readonly>
        </div>
        <div class="product-description">
        <p><?php echo $row['ProductDescription']?>
        </div>
        <div class="delete-button">
        <input type="submit" id="delete" name="Delete" value="Delete">
        </div>   
        </div>
        </td>
        <div class="quantity">
        <td>
        <input type="number" min="1" id="quantity" name="quantity_items_[<?php echo $productQty; ?>]" id ="quantity_items_[<?php echo $productQty; ?>]" value="<?php echo $productQty?>">
        </div>
        <div class="update-quantity">
        <input type="submit" id="update-qty" name="Update" value="Update Qty">
        </div>
        </td>
        <td><input type="text" id="price" name="price" value="<?php echo $row['ProductPrice']?>" readonly></td>

        <input type="hidden" name="productId" value="<?php echo $productId?>">
        <input type="hidden" name="orderId" value="<?php echo $_SESSION["order_id_num"]?>">
        <input type="hidden" name="total" value="<?php echo $total?>">
  </tr> 
</table>
</form>
</div>
<?php
    $loop++;
}
?>


<!--<button type="submit" name="Confirm">Confirm Order</button>-->

<?php
//Total
$customer_id = $_SESSION['customer_id'];

$customer_id = intval($customer_id);
require_once('../mysql.php');

    $sql = "select  p.ProductPrice, orl.OrderQuantity from product p 
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
        $total += $row['OrderQuantity'] * $row['ProductPrice'];
    }

    ?>

<div class="total-price">
<table id="total-price">
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

<div class="form_buttons">
<table>
<tr>
<form action="item_processing.php" method="post" class="clearCart">
<td>
<div class="clear-cart">
<button type="submit" id="clear-cart" name='Reset'>Clear Cart</button>
</div>
</td>
<form action="item_processing.php" method="post">
    <td>
<div class="confirm">
<button type="submit" id="confirm" name="Confirm">Confirm Order</button>
</div>    
</td>
</form>
</tr>
</form>
</div>

</table>
</div>
<?php include("../shared/footer.inc");?>
</body>
</html>