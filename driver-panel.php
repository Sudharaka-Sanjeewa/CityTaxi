<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['did']==0))
{
  header('location:driver-logout.php');
}
else
{
    $did=$_SESSION['did'];
    $query=mysqli_query($con, "select * from driver where ID='$did'");
    $ret=mysqli_fetch_array($query);
}

if(isset($_POST['booking']))
{
    $_SESSION['tid']=$_POST['tID'];
    header('location:driver-booking-details.php');
}

?>

<!doctype html>
<html lang="en">
<head>

    <title>CityTaxi | Driver Panel</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body id="home">

<?php include_once('includes/driver-header.php');?>

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
    <li class="right-side propClone"><a href="driver-panel.php" class="">City Taxi<span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
    <li class="active ">Driver Panel</li>
</ul>
</div>
</div>
</div>
</section>

<section class="top-para">
    <div>
        <h6><b>Status</b>&emsp;>&emsp;<?php echo $ret['Status'];?></h6>
    </div>
    <div>
        <h6><b>Name</b>&emsp;>&emsp;<?php echo $ret['Name'];?></h6>
    </div>
    <div>
        <h6><b>Location</b>&emsp;>&emsp;<?php echo $ret['Location'];?></h6>
    </div>
    <div>
        <?php
        if ($ret['Rating']>0)
        {
            ?>
            <h6 class="star"><b>Rating</b>&emsp;>&emsp;<span class="fa fa-star"></span> <?php echo $ret['Rating'];?></h6>
            <?php
        }
        else
        {
            ?>
            <h6 class="star"><b>Rating</b>&emsp;>&emsp;new driver</h6>
            <?php
        }   
        ?>
    </div>
</section>

<section class="w3l-recent-work-hobbies">
    <div class="recent-work">
        <div class="container">
            <div style="text-align: center;">
                <br><br><h5><b>New Bookings</b></h5><br><br>
            </div>
            <div class="row">
                <?php
                $did=$_SESSION['did'];
                $status="Pending";
                $query=mysqli_query($con,"select * from trip where DID='$did' and Status='$status' order by unix_timestamp(DateTime) desc");
                $cnt=1;
                while ($row=mysqli_fetch_array($query))
                {
                ?>
                <form method="post">
                <button type="submit" class="booking" name="booking">
                    <input type="hidden" name="tID" value="<?php echo $row['ID'];?>">
                    <h6>Pickup - <?php echo $row['PickupL'];?></h6>
                    <h6>Drop - <?php echo $row['DropL'];?></h6>
                    <h6>Time - <?php echo $row['DateTime'];?></h6>
                    <?php
                    if ($row['Status']=="Pending")
                    {
                        ?>
                        <p class="status" style="color: var(--orange);">Pending</p>
                        <?php
                    }
                    else if ($row['Status']=="Canceled")
                    {
                        ?>
                        <p class="status" style="color: red;">Canceled</p>
                        <?php
                    }
                    else if ($row['Status']=="Confirmed")
                    {
                        ?>
                        <p class="status" style="color: blue;">Confirmed</p>
                        <?php
                    }
                    else if ($row['Status']=="Payment Pending")
                    {
                        ?>
                        <p class="status" style="color: #D81B60;">Payment Pending</p>
                        <?php
                    }
                    else
                    {
                        ?>
                        <p class="status" style="color: green;">Paid</p>
                        <?php
                    }   
                    ?>
                    <h6 style="color: gray;"><?php echo $row['Payment'];?> LKR</h6>                    
                </button>   
                <br>
                </form>
                <?php 
                $cnt=$cnt+1;
                }?>
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