<?php
session_start(); 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
if(!isset($_SESSION['user_name'])){ 
    echo "<script>
        alert('Please login');
        window.location.href='login-page.php';  
        </script>"; 
    exit;
}

?>

<html>
<head> 
<!-- basic styling -->
    <title></title>
<link rel="stylesheet" href="../css/members.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet"><link rel="stylesheet" href="../css/members.css"><!--  Link to CSS-->
</head>
<body>

<div class="banner"> <!-- banner div -->
		<img class="banner-image" src="../images/banner.jpg" alt="bannerimagehere" style="    width: 100%;">
        <br><br>
</div>
<?php include("../shared/nav.inc");?>
<div class="username_intro">
<br><br>
    Hello,<strong style="color: red"> 
<?php

$regValue = $_SESSION['user_name']; 
echo $regValue; 

?> 
<!-- Hey 'username' welcome to our site -->
</strong>
   and welcome to the members page.
</div>

<br>

<?php
//Items in cart
$customer_id = $_SESSION['customer_id'];

$customer_id = intval($customer_id);
require_once('../mysql.php');

    $sql = "select p.ProductPrice, orl.OrderQuantity from product p 
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
        $total += $row['OrderQuantity'];
        $itemPrice = $row['ProductPrice'];
    }

    ?>

    <div class="items-in-cart">
    <ul>
        <a href="items.php" target="_blank">(<?php echo $total?>) Items in your cart</a>
    </ul>
    </div>
    <h1 class="table_heading">Products</h1>
    </div>
    <div id="members_table"> <!-- Div for table -->
    <table class="members_image_table"> <!-- Beginning table  -->
        <tbody> 
        	<tr> 
                <td class="productColumn"><a href="members_order.php?this=bcpot020&price=450&image=002"> 
                <img src="../images/product_images/bcpot002_smaller.jpg" id="1" class="productPics"> <p>Copper Red Dish</p></td>

                <td class="productColumn"><a href="members_order.php?this=bcpot030&price=870&image=003">
                <img src="../images/product_images/bcpot003_smaller.jpg" id="2" class="productPics"> <p>Copper Red Vase</p></td>

                <td class="productColumn"><a href="members_order.php?this=bcpot060&price=950&image=006">
                <img src="../images/product_images/bcpot006_smaller.jpg" id="3" class="productPics"> <p>Cyan Dish</p></td>
            </tr>

                <tr>
                    <td class="productColumn"><a href="members_order.php?this=bcpot080&price=106&image=008">
                    <img src="../images/product_images/bcpot008_smaller.jpg" id="4" class="productPics"><p>Light Blue Cup Set</p></td>
                    <td class="productColumn"><a href="members_order.php?this=bcpot090&price=399&image=009">
                    <img src="../images/product_images/bcpot009_smaller.jpg" id="5" class="productPics"><p>Tungsten Blue Dish</p></td>


                </tr> <!-- End cells/columns for table -->
        </tbody>
    </table>
</div>

<?php
  require_once('../mysql.php');
?>

<script type="text/javascript" src="../javascript/members.js"></script>
<?php include("../shared/footer.inc");?>

</body>
</html>