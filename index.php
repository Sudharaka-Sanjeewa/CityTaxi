<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

if(isset($_POST['submit']))
  {
    $name=$_POST['name'];
    $mobileno=$_POST['mobileno'];
    $email=$_POST['email'];
    $message=$_POST['message'];
     
    $query=mysqli_query($con, "insert into message(Name,MobileNumber,Email,Message) value('$name','$mobileno','$email','$message')");
    
    if ($query)
    {
      echo "<script>alert('Your message was sent successfully!.');</script>";
    }
    else
    {
       echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
   
    <title>CityTaxi</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  </head>
  <body id="home">

<?php include_once('includes/header.php');?>

<script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->
<!--bootstrap working-->
<script src="assets/js/bootstrap.min.js"></script>
<!-- //bootstrap working-->
<!-- disable body scroll which navbar is in active -->
<script>
$(function () {
  $('.navbar-toggler').click(function () {
    $('body').toggleClass('noscroll');
  })
});
</script>
<!-- disable body scroll which navbar is in active -->

<div class="w3l-hero-headers-9">
  <div class="css-slider">
    <input id="slide-1" type="radio" name="slides" checked>
    <section class="slide slide-one">
      <div class="container">
        <div class="banner-text">
          <h4>Your Reliable Ride, Anytime, Anywhere</h4>
          <h3>Call Us for Reserve<br>
            77 77 57 100</h3>
            <a href="book-taxi1.php" class="btn logo-button top-margin">Book Now Taxi Ride</a>
        </div>
      </div>
      
    </section>
    <input id="slide-2" type="radio" name="slides">
    <section class="slide slide-two">
      <div class="container">
        <div class="banner-text">
          <h4>Your Reliable Ride, Anytime, Anywhere</h4>
          <h3>Call Us for Reserve<br>
          77 77 57 100</h3>
          <a href="book-taxi1.php" class="btn logo-button top-margin">Book Now Taxi Ride</a>
        </div>
      </div>
      <!-- <nav>
        <label for="slide-2" class="prev">&#10094;</label>
        <label for="slide-1" class="next">&#10095;</label>
      </nav> -->
    </section>
    <header>
      <label for="slide-1" id="slide-1"></label>
      <label for="slide-2" id="slide-2"></label>
    </header>
  </div>
</div>

<section class="w3l-recent-work">
	<div class="jst-two-col">
		<div class="container">
<div class="row">
		<div class="my-bio col-lg-6">

	<div class="hair-make">
		<?php

$ret=mysqli_query($con,"select * from page where PageType='aboutus' ");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
		<h5><?php  echo $row['PageTitle'];?></h5>
		<p class="para mt-2"><?php  echo $row['PageDescription'];?></p><?php } ?>
	</div>
	
	
	</div>
	<div class="col-lg-6 ">
		<img src="assets/images/Taxi3.jpg" alt="product" class="img-responsive about-me">
	</div>

</div>
		</div>
	</div>
</section>

<section class="w3l-inner-banner-main">
  <div class="about-inner">
    <h3 class="header-name">
      Contact Us
    </h3>
  </div>
</section>

<section class="w3l-contact-info-main" id="contact">
    <div class="contact-sec">
        <div class="container">

            <div class="d-grid contact-view">
                <div class="cont-details">
                    <?php

$ret=mysqli_query($con,"select * from page where PageType='contactus' ");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

                    <div class="cont-top">
                        <div class="cont-left text-center">
                            <span class="fa fa-phone text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Call Us</h6>
                            <p class="para"><a href="tel:+94777757100">+<?php  echo $row['MobileNumber'];?></a></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-envelope-o text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Email Us</h6>
                            <p class="para"><a href="mailto:example@mail.com" class="mail"><?php  echo $row['Email'];?></a></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-map-marker text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Address</h6>
                            <p class="para"> <?php  echo $row['PageDescription'];?></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-map-marker text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Time</h6>
                            <p class="para"> <?php  echo $row['Timing'];?></p>
                        </div>
                    </div>
               <?php } ?> </div>

                <div class="map-content-9 mt-lg-0 mt-4">
                    <form method="post">
                        <div class="twice-two">
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name" required="">
                          <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" required="" pattern="[0-9]+" maxlength="10">
                        </div>
                        <div>
                          <input type="email" class="form-control" name="email" placeholder="Email Address" required="">
                        </div>
                        <label>Message</label>
                        <textarea class="form-control" name="message" id="message" placeholder="Write your message" required="">
                        </textarea>
                        <button type="submit" class="btn btn-contact" name="submit">Send Message</button>
                    </form>
                </div>
    </div>
   
    </div></div>
</section>

<?php include_once('includes/footer.php');?>
<!-- move top -->
<button onclick="topFunction()" id="movetop" title="Go to top">
	<span class="fa fa-long-arrow-up"></span>
</button>
<script>
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () {
		scrollFunction()
	};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			document.getElementById("movetop").style.display = "block";
		} else {
			document.getElementById("movetop").style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
</script>
<!-- /move top -->
</body>

</html>