<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid']==0))
{
  header('location:passenger-logout.php');
}

if(isset($_POST['booking']))
{
    $_SESSION['tid']=$_POST['tID'];
    header('location:booking-details.php');
}

?>

<!doctype html>
<html lang="en">
<head>

    <title>Operator Panel | Recent Bookings</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body id="home">
<?php include_once('includes/header.php');?>

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
    <li class="right-side propClone"><a href="operator.php" class="">Operator Panel<span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
    <li class="active ">Recent Bookings</li>
</ul>
</div>
</div>
</div>
</section>

<section class="w3l-recent-work-hobbies">
    <div class="recent-work">
        <div class="container">
            <div style="text-align: center;">
                <br><br><h5><b>Recent Bookings</b></h5><br><br>
            </div>
            <div class="row">
                <?php
                $query=mysqli_query($con,"select * from trip order by unix_timestamp(DateTime) desc");
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