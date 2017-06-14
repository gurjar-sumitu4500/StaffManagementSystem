<DOCTYPE! html>
<html>
<head>
      <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width,  initial-scale=1">
      <title>HomePage</title>
      <link rel="Stylesheet" href="CSS/index.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <style>
      .current{
		 background-color: #ff4000;
	 }
	 </style>
</head>
<body >
<header>
   <nav>
      <ul>
	     <li ><a href="register.php">Register</a></li>
		 <li><a href="login.php">Log-In</a></li>
		 <li><a href="#">Contact</a></li>
		 <li><a href="#">About Us</a></li>
		 <li class="current"><a href="Index.php">Home</a></li>
	  </ul>
   </nav>
</header>
<div style="background-color:#00ff80;">
<content>
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="First_image.jpg" style="width:1500px;height:590px;">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="secon_image.jpg" style="width:1500px;height:590px;">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="third_image.jpg" style="width:1500px;height:590px;">
  <div class="text"></div>
</div>


</div>
<br>

<div style="text-align:center">
  <span class="dot" ></span> 
  <span class="dot" ></span> 
  <span class="dot" ></span> 
</div>
</div>  
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 5000); 
}
</script>
</content>
<footer>
   <ul>
      <li><a href="#">Terms and Conditions</a></li>
	  <li><a href="#">FAQs</a></li>
   </ul>
</footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>