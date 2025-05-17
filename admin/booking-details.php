<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['aid']!=1))
{
  header('location:logout.php');
}
?>

<!DOCTYPE HTML>
<html>
<head>

<title>AdminPanel | Booking Details</title>

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

<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		 <?php include_once('includes/sidebar.php');?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		 <?php include_once('includes/header.php');?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h3 class="title1">Taxi Booking Details</h3>
					<div class="table-responsive bs-example widget-shadow">
						<h4>Booking Details</h4>
						<?php
            $viewid=$_GET['viewid'];
            $ret=mysqli_query($con,"select * from trip where ID='$viewid'");
            
            while ($row=mysqli_fetch_array($ret))
            {
              ?>
              <table class="table table-bordered">
                <tr>
                  <th>Booking ID</th>
                  <td><?php echo $row['ID'];?></td>
                </tr>
                <tr>
                  <th>Pickup Location</th>
                  <td><?php echo $row['PickupL'];?></td>
                </tr>
                <tr>
                  <th>Drop Location</th>
                  <td><?php echo $row['DropL'];?></td>
                </tr>
                <tr>
                  <th>Distance</th>
                  <td><?php echo $row['Distance'];?> km</td>
                </tr>
                <tr>
                  <th>Payment</th>
                  <td><?php echo $row['Payment'];?> LKR</td>
                </tr>
                <tr>
                  <th>Date & Time</th>
                  <td><?php echo $row['DateTime'];?></td>
                </tr>
                <tr>
                  <th>Passenger ID</th>
                  <td><?php echo $row['PID'];?></td>
                </tr>
                <tr>
                  <th>Passenger Name</th>
                  <td><?php echo $row['PName'];?></td>
                </tr>
                <tr>
                  <th>Passenger Mobile</th>
                  <td><?php echo $row['PMobileNumber'];?></td>
                </tr>
                <tr>
                  <th>Driver ID</th>
                  <td><?php echo $row['DID'];?></td>
                </tr>
                <tr>
                  <th>Driver Name</th>
                  <td><?php echo $row['DName'];?></td>
                </tr>
                <tr>
                  <th>Driver Mobile</th>
                  <td><?php echo $row['DMobileNumber'];?></td>
                </tr>
                <tr>
                  <th>Vehicle</th>
                  <td><?php echo $row['Vehicle'];?></td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td><?php echo $row['Status'];?></td>
                </tr>
              </table>
              
              <?php 
            } ?>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		
        <!--//footer-->
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
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>

</body>
</html>