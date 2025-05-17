<?php 

session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid']==0))
{
  header('location:passenger-logout.php');
}
else
{
  $tid=$_SESSION['tid'];
}

if(isset($_POST['cancel']))
{
  $status=$_POST['scancel'];
  $did=$_POST['DID'];    
  $query=mysqli_query($con, "update trip set Status='$status' where ID='$tid'");
  $query1=mysqli_query($con, "update driver set Status='Available' where ID='$did'");
}

?>

<!doctype html>
<html lang="en">
<head>
  
  <title>Operator Panel | Booking Details</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body id="home">

<?php include_once('includes/header.php');?>

<script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->
<script src="assets/js/bootstrap.min.js"></script><!-- bootstrap working-->

<!-- disable body scroll which navbar is in active -->
<script>
$(function () {
  $('.navbar-toggler').click(function () {
    $('body').toggleClass('noscroll');
  })
});
</script>

<!-- breadcrumbs //-->
<section class="w3l-inner-banner-main">
  <div class="breadcrumbs-sub">
    <div class="container">   
      <ul class="breadcrumbs-custom-path">
        <li class="right-side propClone"><a href="operator.php" class="">Operator Panel<span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
        <li class="active ">Booking Details</li>
      </ul>
    </div>
  </div>
</section>

<section class="w3l-contact-info-main" id="contact">
  <div class="contact-sec	">
    <div class="container">
      <div class="cont-details">
        <div class="table-content table-responsive cart-table-content m-t-30">
          <div style="text-align: center;">
            <br><br><h5><b>Booking Details</b></h5><br><br>
          </div>
          <?php
          $query=mysqli_query($con,"select * from trip where ID='$tid'");
          $cnt=1;
          while ($row=mysqli_fetch_array($query))
          {
          ?>
            <table class="table table-bordered">
              <tr>
                <th>Booking Number</th>
                <td><?php echo $row['ID'];?></td>
              </tr>
              <tr>
                <th>Passenger Name</th>
                <td><?php echo $row['PName'];?></td>
              </tr>
              <tr>
                <th>Passenger Mobile Number</th>
                <td><?php echo $row['PMobileNumber'];?></td>
              </tr>
              <tr>
                <th>Driver Name</th>
                <td><?php echo $row['DName'];?></td>
              </tr>
              <tr>
                <th>Driver Mobile Number</th>
                <td><?php echo $row['PMobileNumber'];?></td>
              </tr>
              <tr>
                <th>Vehicle</th>
                <td><?php echo $row['Vehicle'];?></td>
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
                <th>Status</th>
                <td>
                <?php
                  if ($row['Status']=="Pending")
                  {
                    ?>
                    <p style="color: var(--orange);">Pending</p>
                    <?php
                  }
                  else if ($row['Status']=="Canceled")
                  {
                    ?>
                    <p style="color: red;">Canceled</p>
                    <?php
                  }
                  else if ($row['Status']=="Confirmed")
                  {
                    ?>
                    <p style="color: blue;">Confirmed</p>
                    <?php
                  }
                  else if ($row['Status']=="Payment Pending")
                  {
                    ?>
                    <p style="color: #D81B60;">Payment Pending</p>
                    <?php
                  }
                  else
                  {
                    ?>
                    <p style="color: green;">Paid</p>
                    <?php
                  }   
                ?>
                </td>
              </tr>
            </table>
          <?php } ?>
        </div>
      </div>
      <div>
      <?php
      $query=mysqli_query($con,"select * from trip where ID='$tid'");
      $cnt=1;
      while ($row=mysqli_fetch_array($query))
      {
        if ($row['Status']=="Pending")
        {
          ?>
          <form method="post">
          <input type="hidden" name="DID" value="<?php echo $row['DID'];?>">
          <input type="hidden" name="scancel" value="Canceled">
          <button type="submit" class="action-button" name="cancel">Cancel</button>
          </form>
          <?php
        }
      }
      ?>  
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