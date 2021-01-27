<?php
//require_once('../mysql.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/new_customer_registration.css"><!--  Link to CSS-->
</head>
<body>
<?php include("../shared/banner.inc"); ?>
<?php include("../shared/nav.inc"); ?>

<?php
//Variables
$firstName = "";
$lastName = "";
$address = "";
$phoneNumber = "";
$email = "";
$message = "";

if(isset($_POST['submit'])) { //Connecting $_POST to submit button
    require_once('../mysql.php');

    //Submitting and posting to Database. These arrays are also connected to what is below in the HTML form.
    $firstName = $_POST['firstName']; 
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];

    //If fields are empty, display all fields are required. 
    if (!empty($firstName) || !empty($lastName) || !empty($address) || !empty($phoneNumber)) {

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error()); //If failed, quote connection failed and die.
        }

    } else {
        echo "All fields are required";
      die();
    }

//Inserting details into databse table. Value (?) meaning details are not yet defined. 5 '?' for 5 entries. 
    $INSERT = "INSERT Into customer (CustomerGivenName, CustomerLastName, CustomerAddress, CustomerPhoneNumber, CustomerEmail) values(?,?,?,?,?)";

    //preparing (INSERT) 
    $stmt = $conn->prepare($INSERT);
    //binding parameters/variables as defined above. 
    $stmt->bind_param('sssss',$firstName, $lastName, $address, $phoneNumber, $email);
    $stmt->execute();
    $message = "New Customer Record Added Successfully";

    require_once('../disconnect.php');
}
?>

<div class="regoform"><h1> Customer Registration </h1></div>
<div class="main">
     <form action="new_customer_registration.php" method="post"> 

        <div id="name">

            <h2 class="name">Name</h2>
            <label for="firstName"></label>
            <input class="firstname" type="text" name="firstName" required><br>
            <label class="firstlabel">First Name</label>

            <input class="lastname" type="text" name="lastName" required>
            <label class="lastlabel">Last Name</label>
        </div>
        
        <h2 class="name">Address</h2>
        <input class="address" type="text" name="address" required>

        <h2 class="name">Email</h2>
        <input class="email" type="text" name="email" required>

        <h2 class="name">Phone</h2>

        <input class="number" type="text" name="phoneNumber" required>

        <br><span id="error" style="color: red;"><?php echo $message; ?></span><br>

        <input type="submit" name="submit" value="submit">
</form>
</div>


<!-- <div>  Form creation below  -->
<!-- <div class="regoform"><h1> Customer Registration </h1></div>

<form action="new_customer_registration.php" method="post"> 
<div class="main">

<div id="name">
<h2 class="name">Name</h2>

<label for="firstName"><b>First Name</b></label>
<input type="text" name="firstName" required>

<label for="lastName"><b>Last Name</b></label>
<input type="text" name="lastName" required>
</div>

<label for="address"><b>Address</b></label>
<input type="text" name="address" required>

<label for="phoneNumber"><b>Phone Number</b></label>
<input type="number" name="phoneNumber" required>

<label for="email"><b>Email</b></label>
<input type="email" name="email" required>

<br><br><span id="error" style="color: red;"><?php //echo $message; ?></span><br><br>
<input type="button" name="cancelvalue" value="Cancel" onclick="closeThis();return false;">
<input type="reset" value="Reset">
<input type="submit" name="submit" value="submit">
</div> -->

<script type="text/javascript" src="../javascript/new_customer_registration.js"></script>
<?php include("../shared/footer.inc");?>

</body>
</html>