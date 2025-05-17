<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['reset']))
  {
	$email=$_POST['email'];
    $mobile=$_POST['mobile'];

    $query=mysqli_query($con,"select ID from user where Email='$email' and MobileNumber='$mobile'");
    $ret=mysqli_fetch_array($query);
    
	if($ret>0)
	{
		$_SESSION['email']=$email;
    	$_SESSION['mobile']=$mobile;
     	header('location:reset-password.php');
    }
    else{
      	$msg="Invalid Details. Please try again.";
    }
  }
?>

<!DOCTYPE HTML>
<html>
<head>

<title>CityTaxi | Admin Forgot Password</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

</head> 

<body class="cbp-spmenu-push" style="background-color: #F1F1F1; height:650px;">
	<div class="main-content">
		<!-- main content start-->
		<div>
			<div class="main-page login-page ">
				<h3 class="title1">Forgot Password</h3>
				<div class="widget-shadow">
					<div class="login-top">
						<h4>Welcome back to CityTaxi AdminPanel</h4>
					</div>
					<div class="login-body">
						<form role="form" method="post" action="">
							<p style="font-size:16px; color:red" align="center"> <?php if($msg){
								echo $msg;
							}  ?> </p>
							<input type="text" name="email" class="lock" placeholder="Email" required="true">
							<input type="text" name="mobile" class="lock" placeholder="Mobile Number" required="true" maxlength="10" pattern="[0-9]+">
							<input type="submit" name="reset" value="Reset">
							<div class="forgot-grid">
								<div class="forgot">
									<a href="index.php">Already have an account</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</div>
	
<!-- Classie -->
<script src="js/classie.js"></script>
<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
</script>
<!--scrolling js-->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.js"> </script> <!-- Bootstrap Core JavaScript -->

</body>
</html>