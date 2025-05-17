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
    $pname=$_POST['pname'];
    $query=mysqli_query($con, "update passenger set Name='$pname' where ID='$pid'");
    if ($query)
    {
        echo '<script>alert("Profile updated successully.")</script>';
        echo '<script>window.location.href=passenger-profile.php</script>';
    }
    else
    {
     
      echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
 
    <title>Salon S | Profile</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body id="home">

<?php include_once('includes/header.php');?>

<script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->

<script src="assets/js/bootstrap.min.js"></script> <!-- //bootstrap working-->

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
                <li class="active ">profile</li>
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
                    </div>
                    <?php
                    } ?>
                </div>
                <div class="map-content-9 mt-lg-0 mt-4">
                    <h3>Update Profile</h3>
                    <form method="post" name="update" onsubmit="return checkpass();">
                        <?php
                        $pid=$_SESSION['pid'];
                        $ret=mysqli_query($con,"select * from passenger where ID='$pid'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($ret))
                        {
                        ?>
                        <div>
                            <label>First Name</label>
                            <input type="text" class="form-control" name="pname" value="<?php  echo $row['Name'];?>" required="true">
                        </div>
                        <div>
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" name="pmobile" value="<?php  echo $row['MobileNumber'];?>"  readonly="true">
                        </div>
                        <div>
                            <label>Email address</label>
                            <input type="text" class="form-control" name="pemail" value="<?php  echo $row['Email'];?>"  readonly="true">
                        </div>
                        <div>
                            <label>Signup Date</label>
                            <input type="text" class="form-control" name="pregdate" value="<?php  echo $row['RegDate'];?>"  readonly="true">
                       </div> <?php
                        } ?>
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