<!DOCTYPE html>
<html>
<head>
	<title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/production.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
</head>
<body>

<?php session_start()?>

<div class="banner"> <!-- banner div -->
<img class="banner-image" src="../images/banner.jpg" alt="bannerimagehere" style="width:100%">
</div>

<?php include("../shared/nav.inc");?>

<h1 class=indexH1>Production</h1>
<div class="slider">
    <div class="slides"> <!-- Image slideshow buttons -->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">
        <input type="radio" name="radio-btn" id="radio4">
        <input type="radio" name="radio-btn" id="radio5">

        <div class="slide first">
            <img src="../images/production_images/openingclay.jpg">
        </div>
        <div class="slide">
            <img src="../images/production_images/finishing.jpg">
        </div>
        <div class="slide">
            <img src="../images/production_images/finishing2.jpg">
        </div>
        <div class="slide">
            <img src="../images/production_images/finishingsmall.jpg">
        </div>
        <div class="slide">
            <img src="../images/production_images/liftingclay.jpg">
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
   and welcome to the production page.
</div>

<div class="home_page_intro_paragraph">
<p>Bazaar Ceramics are constantly experimenting with new designs and techniques. 
      The process of developing a particular range of ceramics, starts with the design process.  
      The ceramic designers and gallery director meet regularly to discuss new ideas for product ranges.  
      It may be that the designers are following through on an inspiration from a field trip or perhaps 
      the gallery director has some suggestions to make based on feedback from customers.
</p>  
<p>
      Depending on the type of decoration, the designers may apply the decoration at this stage, or after they have been “bisqued” (fired to 1000 degrees celsius).  
      These prototype designs go through a lengthy development stage of testing and review until the designer is happy with the finished product.  
      At this stage a limited number of pots are produced and displayed in the gallery.  
      If they do well in the gallery, they become a “standard line”.
</p>
</div>
<br>
</div>
</div>
<?php include("../shared/footer.inc");?>

<script type="text/javascript" src="../javascript/production.js"></script>
</body>
</html>