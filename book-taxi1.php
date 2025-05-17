<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['pid']==0))
{
  header('location:passenger-logout.php');
}

if(isset($_POST['find']))
{
    $_SESSION['pickup']=$_POST['pickup'];
    $_SESSION['drop']=$_POST['drop'];
    header('location:book-taxi2.php');
}

?>

<!doctype html>
<html lang="en">
<head>

    <title>CityTaxi | Book Taxi Ride</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Template JavaScript -->
    <script defer src="https://maps.googleapis.com/maps/api/js?libraries=places&key=" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   
   
</head>

<body id="home">
<?php include_once('includes/header.php');?>

<script src="assets/js/map.js"></script> <!-- google map -->
<script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->
<script src="assets/js/bootstrap.min.js"></script><!--bootstrap working-->
<!-- disable body scroll which navbar is in active -->
<script>
$(function () {
  $('.navbar-toggler').click(function () {
    $('body').toggleClass('noscroll');
  })
});
</script>

<!-- breadcrumbs -->
<section class="w3l-inner-banner-main">
<div class="breadcrumbs-sub">
<div class="container">   
<ul class="breadcrumbs-custom-path">
    <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
    <li class="active ">Book Now Taxi Ride</li>
</ul>
</div>
</div>
</div>
</section>

<section class="w3l-recent-work">
<div class="jst-two-col">
<div class="container">
    <div class="row">
		<div class="my-bio col-lg-6">
            <div class="hair-make">
               <div class='well define_height'>
                    <form method="post">  
                    <form id="distance_form"> 
                        <div class="form-group">
                            <label>Pickup Location</label>
                            <input class="form-control" id="from_places" name="pickup" placeholder="Enter Pickup Location"/>
                            <input id="origin" name="origin" required="" type="hidden"/>
                            <a style="font-size: 14px; color: orangered; margin-left:20px;" onclick="getCurrentPosition()">Set Current Location</a>
                        </div>
                        <div class="form-group">
                            <label>Drop Location</label>
                            <input class="form-control" id="to_places" name="drop" placeholder="Enter Drop Location"/>
                            <input id="destination" name="destination" required="" type="hidden"/>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="travel_mode" name="travel_mode" value="DRIVING">
                        </div>
                        <input type="submit" class="logo-button" name="find" value="Find Nearest Drivers">
                    </form>
                    </form>  
                </div>
            </div>
        </div>
        <div class="col-lg-6 ">
            <noscript>
                <div class='alert alert-info'>
                    <h4>Your JavaScript is disabled</h4>
                    <p>Please enable JavaScript to view the map.</p>
                </div>
            </noscript>
            <div id="map" style="height: 370px; width: 100%;"></div>
	    </div>
    </div>
</div>
</div>
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