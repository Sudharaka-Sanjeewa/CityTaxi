<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    
	$query=mysqli_query($con,"select ID from user where UserName='$username' && Password='$password'");
    $ret=mysqli_fetch_array($query);
    
	if($ret>0)
	{
		$_SESSION['aid']=$ret['ID'];
     	header('location:dashboard.php');
	}     
    else
	{
    	$msg="Invalid Details.";
    }
  }
?>

<!DOCTYPE HTML>
<html>
<head>

<title>CityTaxi | Admin Login</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> <!-- Bootstrap Core CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' /> <!-- Custom CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> <!-- font CSS -->
 <script src="js/jquery-1.11.1.min.js"></script> <!-- js-->
<script src="js/modernizr.custom.js"></script> <!-- js-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'> <!--webfonts-->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">

</head>

<body class="cbp-spmenu-push" style="background-color: #F1F1F1; height:650px;">
	<div class="main-content">
		<!-- main content start-->
		<div>
			<div class="main-page login-page ">
				<h3 class="title1">Admin Login</h3>
				<div class="widget-shadow">
					<div class="login-top">
						<h4>Welcome back to CityTaxi AdminPanel</h4>
					</div>
					<div class="login-body">
						<form role="form" method="post" action="">
							<p style="font-size:16px; color:red" align="center"> <?php if($msg){
								echo $msg;
							}  ?> </p>
							<input type="text" class="user" name="username" placeholder="Username" required="true">
							<input type="password" name="password" class="lock" placeholder="Password" required="true">
							<input type="submit" name="login" value="Login">
							<div class="forgot-grid">
								<div class="forgot">
									<a href="../index.php">Back to Home</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="forgot-grid">
								<div class="forgot">
									<a href="forgot-password.php">forgot password?</a>
								</div>
								<div class="clearfix"> </div>
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