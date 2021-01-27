<!DOCTYPE html>
<html>
<head>
	<title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
</head>
<body>

<?php session_start()?>


<div class="banner"> <!-- banner div -->
<img class="banner-image" src="images/banner.jpg" alt="bannerimagehere" style="width:100%">
</div>

<?php include("shared/index_nav.inc");?>

<h1 class=indexH1>Need Art, Want Art, Love Art</h1>
<div class="slider">
    <div class="slides"> <!-- Image slideshow buttons -->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">
        <input type="radio" name="radio-btn" id="radio4">
        <input type="radio" name="radio-btn" id="radio5">

        <div class="slide first">
            <img src="images/home_page_intro_img.jpg">
        </div>
        <div class="slide">
            <img src="images/product_images/download5.jpg">
        </div>
        <div class="slide">
            <img src="images/product_images/download6.jpg">
        </div>
        <div class="slide">
            <img src="images/product_images/download7.jpg">
        </div>
        <div class="slide">
            <img src="images/product_images/download1.jpg">
        </div>

        <div class="navigation-auto">
            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn3"></div>
            <div class="auto-btn4"></div>
            <div class="auto-btn5"></div>
        </div>
        <div class="navigation-manual">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
            <label for="radio4" class="manual-btn"></label>
            <label for="radio5" class="manual-btn"></label>
        </div>
</div>
<div class="home_page_intro">
<div class="username_intro">
<br><br>
    Hello,<strong style="color: red"> 
<?php

 //Grabbing username of user
if( isset($_SESSION['user_name']) )
{
echo $_SESSION['user_name']; //echo username of user 
}?> 
<!-- Hey 'username' welcome to our site -->
</strong>
   and welcome to the home page.
</div>

<div class="home_page_intro_paragraph">
<p>Bazaar Ceramics is committed to producing unique, evocative contemporary Ceramic 
Art of the highest technical quality.</p>  
<p>Our Goals:</p>
<ul>
    <li>To produce unique hand crafted pieces for the individual and corporate collector</li>
    <li>To showcase the best of Australian Ceramic Art and Design</li>
    <li>To provide an extensive range of well crafted and designed domestic ware</li>
    <li>To showcase technical excellence in ceramic technology</li>
</ul>
</div>
<br>
<br>
</div>
</div>
<?php include("shared/footer.inc");?>

<script type="text/javascript" src="javascript/index.js"></script>
</body>
</html>