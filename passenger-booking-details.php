<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
require __DIR__ . "/vendor/autoload.php";

if (strlen($_SESSION['pid']==0))
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
else if(isset($_POST['pay']))
{
  $payment=$_POST['Payment']*100;
  $_SESSION['pname']=$_POST['pname'];
  $_SESSION['pmobile']=$_POST['pmobile'];
  $_SESSION['did']=$_POST['DID'];
  $_SESSION['dmobile']=$_POST['dmobile'];
  $_SESSION['status']=$_POST['spaid'];
  $_SESSION['payment']=$_POST['Payment'];
  
  $stripe_secret_key = "";
  \Stripe\Stripe::setApiKey($stripe_secret_key);
  $checkout_session = \Stripe\Checkout\Session::create([
      "mode" => "payment",
      "success_url" => "http://localhost/CityTaxi/passenger-invoice.php",
      "cancel_url" => "http://localhost/CityTaxi/passenger-booking-details.php",
      "locale" => "auto",
      "line_items" => [
          [
              "quantity" => 1,
              "price_data" => [
                  "currency" => "lkr",
                  "unit_amount" => $payment,
                  "product_data" => [
                      "name" => "Your Total Payment is"
                  ]
              ]
          ]        
      ]
  ]);
  http_response_code(303);
  header("Location: " . $checkout_session->url);
}
else if(isset($_POST['rate']))
{
  if($_POST['rating']=='Better Experience')
  {
    $rating=4;
  }
  else if($_POST['rating']=='Good Experience')
  {
    $rating=2;
  }
  else if($_POST['rating']=='Bad Experience')
  {
    $rating=0;
  }
  else
  {
    echo "<script>alert('Please select rating');</script>";
  }
  
  $query2=mysqli_query($con, "update trip set Rating='$rating' where ID='$tid'");

  if($query2)
  {
    $did=$_POST['DID']; 
    $query3=mysqli_query($con,"Select Rating from trip where DID='$did'");
    $totaltrip=mysqli_num_rows($query3);
    $totalrating=0;
    while($row3=mysqli_fetch_array($query3))
    {
      $total_rating=$row3['Rating'];
      $totalrating=$totalrating+$total_rating;
    }
    $avaragerating=$totalrating/$totaltrip;
    $query4=mysqli_query($con, "update driver set Rating='$avaragerating' where ID='$did'");
    
    if($query4)
    {
      echo "<script>alert('Thank you for Rating');</script>";
    }
    else
    {
      echo "<script>alert('Driver rating update error');</script>";
    }
  }
  else
  {
    echo "<script>alert('Trip rating update error');</script>";
  }
}

?>

<!doctype html>
<html lang="en">
<head>
  
  <title>CityTaxi | Booking Details</title>

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
        <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
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
            if ($row['Status']=="Paid" && $row['Rating']=="")
            {
              ?>
              <form method="post">
                <div>
                    <h5><b>Please Rating about your trip experience</b></h5>
                    <select class="form-control" name="rating" required="true" style="width:36%; margin:20px 0 20px 0">
                        <option>Better Experience</option>
                        <option>Good Experience</option>
                        <option>Bad Experience</option>
                    </select>
                </div>
                <input type="hidden" name="DID" value="<?php echo $row['DID'];?>">
                <button type="submit" class="action-button" name="rate" style="margin:0 0 40px 0;">Rate</button>
              </form>
              <?php
            }
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
        else if ($row['Status']=="Payment Pending")
        {
          ?>
          <form method="post">
          <input type="hidden" name="Payment" value="<?php echo $row['Payment'];?>">
          <input type="hidden" name="DID" value="<?php echo $row['DID'];?>">
          <input type="hidden" name="dmobile" value="<?php echo $row['DMobileNumber'];?>">
          <input type="hidden" name="pname" value="<?php echo $row['PName'];?>">
          <input type="hidden" name="pmobile" value="<?php echo $row['PMobileNumber'];?>">
          <input type="hidden" name="spaid" value="Paid">
          <button type="submit" class="action-button" name="pay">Pay Now</button>
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