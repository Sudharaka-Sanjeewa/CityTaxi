<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

if(isset($_POST['submit']))
  {
    $pool=array ("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T" , "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t" , "u", "v", "w", "x", "y", "z", "@", "#", "$", "&", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $count=1;
    $randompassword="";
    $rn;
    $randomchar="";

    while ($count <= 8)
    {
        $rn=rand(0,count($pool) - 1);
        $randomchar=$pool[$rn];
        $randompassword=$randompassword.$randomchar;
        ++$count;
    }

    $name=$_POST['name'];
    $mobileno=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $vehicle=$_POST['vehicle'];

    $ret=mysqli_query($con, "select Email from driver where Email='$email' || MobileNumber='$mobileno'");
    $result=mysqli_fetch_array($ret);
    
    if($result>0)
    {
        echo "<script>alert('This Email or Contact Number already associated with another account!.');</script>";
    }
    else{
        $password=md5($randompassword);

        $query=mysqli_query($con, "insert into driver(Name, MobileNumber, Email, Password, Vehicle) value('$name','$mobileno','$email','$password','$vehicle' )");

        if ($query)
        {
            $to="{$email}";
            $mail_subject='Welcome to CityTaxi';
            $email_body="<b>CityTaxi Driver Profile Details</b><br><br>";
            $email_body.="<b>Name -</b> {$name}<br>";
            $email_body.="<b>Vehicle -</b> {$vehicle}<br>";
            $email_body.="<b>Mobile -</b> {$mobileno}<br>";
            $email_body.="<b>Email/Username -</b> {$email}<br>";
            $email_body.="<b>Password -</b> {$randompassword}<br><br>";
            $email_body.="You can change your profile details after Login.<br>";
            $email_body.="Thank you for join with us.<br>";
            $email_body.="Drive Safe!<br><br>";
            $email_body.="Best regards,<br>";
            $email_body.="CityTaxi team.<br>";	
            $header="From: \r\nContent-Type: text/html;";

            $send_mail_result = mail($to, $mail_subject, $email_body, $header);

            if($send_mail_result)
            {
                echo "<script>alert('You have successfully registered with CityTaxi service. Please check your Email Inbox for your Login Password');</script>";
            }
            else
            {
                echo "<script>alert('Email not sent');</script>";
            }
        }
        else
        {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
 

    <title>CityTaxi | Driver Signup</title>

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
    <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
    <li class="active">
    Driver Signup</li>
</ul>
</div>
</div>
    </div>
</section>
<!-- breadcrumbs //-->
<section class="w3l-contact-info-main" id="contact">
    <div class="contact-sec	">
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
                    <h3>Join with us</h3>
                    <form method="post" name="signup" onsubmit="return checkpass();">
                        <div>
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required="">
                        </div>
                        <div>
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" name="mobilenumber" placeholder="Mobile Number (eg - 777757100)" required="" pattern="[0-9]+" maxlength="10">
                        </div>
                        <div>
                            <label>Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Email Address (eg - yourname@domain.com)" required="">
                        </div>
                        <div>
                            <label>Vehicle</label>
                            <select class="form-control" name="vehicle" required="true">
                                <option>Maruti</option>
                                <option>Alto</option>
                                <option>Wagon R</option>
                                <option>Audi</option>
                                <option>BMW</option>
                                <option>Benz</option>
                            </select>
                        </div>
                        <div class="twice-two" style="padding-top:10px;">
                        <a class="link--gray" style="color: orangered;" href="driver-login.php">Already have an Account? <b>Login</b></a>
                        </div>
                        <button type="submit" class="btn btn-contact" name="submit">Signup</button>
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