<?php
if (!isset($_SESSION['username'])) {
	header("Location: login.php?location=galleria2020");
} ?>
<style>
* {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  text-align: center;
  max-width: 1000px;
  position: relative;
  margin: auto;
}

.mySlides {
    display: none;
}

/* Next & previous buttons */



/* On hover, add a black background color with a little bit see-through */


/* The dots/bullets/indicators */
.dot {
  cursor:pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
  font-size: 10px;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
</style>
<div class='jumbotron text-center jumbotron-fluid'>Galleria 2020</div>
<div class="page_text">

	<div class="slideshow-container">
	<!--
	  <div class="mySlides fade">
	    <div class="numbertext">1 / 3</div>
	    <img src="img1.jpg" style="width:100%">
	  </div>
	--><?php

	if ($handle = opendir('img/foto2020/')) {
		$blacklist = array('.', '..', 'thumb');		//file e cartelle da non mostrare
		while (false !== ($file = readdir($handle))) {
			if (!in_array($file, $blacklist)) {
				echo '<div class="mySlides">
						<img src="img/foto2020/' . $file . '" style="width:100%">
					  </div>';
			}
		}
		closedir($handle);
	} ?>

	</div>
	<br>

	<div style="text-align:center">
	  <!--<span class="dot" onclick="currentSlide(1)"></span>-->


	</div>
</div>

<script>
$(document).keydown(function(e) {
    switch(e.which) {
      case 37: plusSlides(-1);// left
      break;

      case 38: // up
      break;

      case 39: plusSlides(1);// right
      break;

      case 40: // down
      break;

      default: return; // exit this handler for other keys
    }
  });

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>
