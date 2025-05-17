<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

if(isset($_POST['login']))
  {
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    $query=mysqli_query($con,"select * from user where UserName='$username' && Password='$password'");
    $ret=mysqli_fetch_array($query);
    
    if($ret>0){
        $_SESSION['uid']=$ret['ID'];
        header('location:operator.php');
    }
    else{
    echo "<script>alert('Invalid Details.');</script>";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
 

    <title>CityTaxi | Operator Login</title>

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

<!-- breadcrumbs -->
<section class="w3l-inner-banner-main">
<div class="breadcrumbs-sub">
<div class="container">   
<ul class="breadcrumbs-custom-path">
    <li class="right-side propClone"><a href="operator.php" class="">CityTaxi<span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
    <li class="active ">
    Operator Login</li>
</ul>
</div>
</div>
    </div>
</section>
<!-- breadcrumbs //-->
<section class="w3l-contact-info-main" id="contact">
    <div class="contact-sec">
        <div class="container" style="padding: 30px 350px 0 350px;">
                <div class="map-content-9 mt-lg-0 mt-4">
                <h3>Login to Operator Panel</h3>
                    <form method="post">
                        <div>
                            <label>User Name</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" required="true">
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="true">
                        </div>
                        <button type="submit" class="btn btn-contact" name="login">Login</button>
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