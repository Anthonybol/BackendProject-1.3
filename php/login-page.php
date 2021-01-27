
<!DOCTYPE html>
<html>
<head>
	<title></title>

<link rel="stylesheet" href="../css/login-page.css"><!--  Link to CSS-->

</head>
<body>

<?php include("../shared/nav.inc");?>


<div class="loginbox">
<form name="input" method="POST" action="login.php"> 
    <img src="../images/signin.png" class="avatar">
    <h1 class="login_here">Login Here</h1>
    <form>
        <p>Username</p>
        <input type="text" input id="a" name="username" placeholder="Enter Username">
        <p>Password</p>
        <input type="password" input id="b" name="password"  placeholder="Enter Password">
        <input type="submit" name=""  value="Login">
        <a href="new_customer_registration.php">Don't have an account?</a>
    </form>
</div>
<script type="text/javascript" src="../javascript/login.js"></script>
<?php include("../shared/footer.inc");?>
</body>
</html>

<?php
require_once('../mysql.php');
?>