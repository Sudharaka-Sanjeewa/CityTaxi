<?php 
session_start();
error_reporting(0);

include('includes/dbconnection.php');

if (strlen($_SESSION['pid']==0))
{
  header('location:passenger-logout.php');
}

if(isset($_POST['update']))
{
    $pid=$_SESSION['pid'];
    $cpassword=md5($_POST['cpassword']);
    $npassword=md5($_POST['npassword']);
    
    $query=mysqli_query($con,"select ID from passenger where ID='$pid' and Password='$cpassword'");
    $row=mysqli_fetch_array($query);
    
    if($row>0)
    {
        $ret=mysqli_query($con,"update passenger set Password='$npassword' where ID='$pid'");
        echo '<script>alert("Your password successully changed.")</script>';
    }
    else
    {
        echo '<script>alert("Your current password is wrong.")</script>';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
 
    <title>Salon S | Setting</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body id="home">

<?php include_once('includes/header.php');?>

<script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->

<script src="assets/js/bootstrap.min.js"></script><!-- //bootstrap working-->

<!-- disable body scroll which navbar is in active -->
<script>
$(function () {
  $('.navbar-toggler').click(function () {
    $('body').toggleClass('noscroll');
  })
});
</script>

<script type="text/javascript">
    function checkpass()
    {
    if(document.changepassword.npassword.value!=document.changepassword.conpassword.value)
    {
        alert('New Password and Confirm Password field does not match');
        document.changepassword.conpassword.focus();
        return false;
    }
    return true;
    } 
</script>

<!-- breadcrumbs -->
<section class="w3l-inner-banner-main">
    <div class="breadcrumbs-sub">
        <div class="container">   
            <ul class="breadcrumbs-custom-path">
                <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
                <li class="active ">Change Password</li>
            </ul>
        </div>
    </div>
</section>

<section class="w3l-contact-info-main" id="contact">
    <div class="contact-sec	">
        <div class="container">
            <div class="d-grid contact-view">
                <div class="cont-details">
                    <?php
                    $ret=mysqli_query($con,"select * from page where PageType='contactus'");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret))
                    {
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
                    </div> <?php 
                    } ?> 
                </div>
                
                <div class="map-content-9 mt-lg-0 mt-4">
                    <h3>Password Change</h3>
                    <form method="post" name="changepassword" onsubmit="return checkpass();">
                        <div >
                            <label>Current Password</label>
                            <input type="password" class="form-control" placeholder="Current Password" id="currentpassword" name="cpassword" value="" required="true">
                        </div>
                           <div>
                            <label>New Password</label>
                            <input type="password" class="form-control" placeholder="New Password" id="newpassword" name="npassword" value="" required="true">
                        </div>
                        <div>
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword" name="conpassword" value=""  required="true">
                        </div>
                        <button type="submit" class="btn btn-contact" name="update">Save Change</button>
                    </form>
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

</body>
</html>