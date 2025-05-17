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

<title>CityTaxi | Admin Panel</title>

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
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--Calender-->
<link rel="stylesheet" href="css/clndr.css" type="text/css" />
<script src="js/underscore-min.js" type="text/javascript"></script>
<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
<script src="js/clndr.js" type="text/javascript"></script>
<script src="js/site.js" type="text/javascript"></script>
<!--End Calender-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

</head> 

<body class="cbp-spmenu-push">
	<div class="main-content">
		<?php include_once('includes/sidebar.php');?>
		<?php include_once('includes/header.php');?>
		<!-- main content start-->
		<div id="page-wrapper" class="row calender widget-shadow">
			<div class="main-page">
				<div class="row calender widget-shadow">
					<div class="row-one">
					<div class="col-md-4 widget">
						<?php
						$query1=mysqli_query($con,"Select Payment from trip where Status='Paid' and date(DateTime)=CURDATE();");
						$todaysales=0;
						while($row1=mysqli_fetch_array($query1))
						{
							$today_sales=$row1['Payment'];
							$todaysales=$todaysales+$today_sales;
						}
						?>
						<div class="stats-left">
							<h5>Today</h5>
							<h4>Income</h4>
						</div>
						<div class="stats-right">
							<label><?php if($todaysales==""): echo "0"; else: echo $todaysales/10; endif; ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-mdl">
						<?php
						$query2=mysqli_query($con,"Select * from trip where Status='Paid'");
						$totalpaid=mysqli_num_rows($query2);
						?>
						<div class="stats-left">
							<h5>Paid</h5>
							<h4>Bookings</h4>
						</div>
						<div class="stats-right">
							<label> <?php echo $totalpaid;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-last">
						<?php
						$query3=mysqli_query($con,"Select * from passenger");
						$totalpassenger=mysqli_num_rows($query3);
						?>
						<div class="stats-left">
							<h5>Registered</h5>
							<h4>Passengers</h4>
						</div>
						<div class="stats-right">
							<label><?php echo $totalpassenger;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"></div>	
				</div>
			</div>
				<div class="row calender widget-shadow">
					<div class="row-one">
						<div class="col-md-4 widget">
						<?php
						$query4=mysqli_query($con,"Select Payment from trip where Status='Paid'");
						$totalsales=0;
						while($row2=mysqli_fetch_array($query4))
						{
							$total_sales=$row2['Payment'];
							$totalsales=$totalsales+$total_sales;
						}
						?>
						<div class="stats-left">
							<h5>Total</h5>
							<h4>Income</h4>
						</div>
						<div class="stats-right">
							<label><?php if($totalsales==""): echo "0"; else: echo $totalsales/10; endif; ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-mdl">
						<?php
						$query5=mysqli_query($con,"Select * from trip where Status='Confirmed'");
						$totalconfirm=mysqli_num_rows($query5);
						?>
						<div class="stats-left">
							<h5>Confirmed</h5>
							<h4>Bookings</h4>
						</div>
						<div class="stats-right">
							<label><?php echo $totalconfirm;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-last">
						<?php
						$query9=mysqli_query($con,"Select * from passenger");
						$totalpassenger=mysqli_num_rows($query9);
						?>
						<div class="stats-left">
							<h5>Unregistered</h5>
							<h4>Passengers</h4>
						</div>
						<div class="stats-right">
							<label><?php echo $totalpassenger;?></label>
						</div>
						<div class="clearfix"></div>	
					</div>
					<div class="clearfix"></div>	
				</div>
			</div>
				<div class="row calender widget-shadow">
					<div class="row-one">
						<div class="col-md-4 widget">
						<?php
						$query7=mysqli_query($con,"select Payment from trip where Status='Paid'");
						$totalsales=0;
						while($row3=mysqli_fetch_array($query7))
						{
							$total_sales=$row3['Payment'];
							$totalsales=$totalsales+$total_sales;
						}
						?>
						<div class="stats-left ">
							<h5>Total</h5>
							<h4>Sales</h4>
						</div>
						<div class="stats-right">
							<label><?php if($totalsales==""): echo "0"; else: echo $totalsales; endif; ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
						<div class="col-md-4 widget states-mdl">
							<?php
							$query8=mysqli_query($con,"Select * from trip where Status='Canceled'");
							$totalcancel=mysqli_num_rows($query8);
							?>
						<div class="stats-left">
							<h5>Canceled</h5>
							<h4>Bookings</h4>
						</div>
						<div class="stats-right">
							<label><?php echo $totalcancel;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
						<div class="col-md-4 widget states-last">
						<?php
						$query6=mysqli_query($con,"Select * from driver");
						$totaldriver=mysqli_num_rows($query6);
						?>
						<div class="stats-left">
							<h5>Registered</h5>
							<h4>Drivers</h4>
						</div>
						<div class="stats-right">
							<label><?php echo $totaldriver;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"></div>	
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
		
<?php include_once('includes/footer.php');?> <!--footer-->
        
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