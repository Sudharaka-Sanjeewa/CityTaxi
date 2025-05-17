<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "/vendor/autoload.php";

if (strlen($_SESSION['uid']==0))
{
  header('location:logout.php');
}
else
{
    // Google Maps API Key 
    $GOOGLE_API_KEY = ''; 
    
    // Addresses between which distances will be calculated 
    $addressFrom=$_SESSION['pickup']; //start address 
    $addressTo=$_SESSION['drop']; //end address 
    
    // Format address string 
    $formatted_address_from = str_replace(array(' ','&'), '+', $addressFrom); 
    $formatted_address_to   = str_replace(array(' ','&'), '+', $addressTo); 
    
    // Geocoding API request with start address 
    $geocode_data_start = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address={$formatted_address_from}&key={$GOOGLE_API_KEY}"); 
    $outputFrom = json_decode($geocode_data_start); 
    if(!empty($outputFrom->error_message)){ 
        die("API Error: ".$outputFrom->error_message); 
    }elseif(empty($outputFrom->results[0])){ 
        die("Returns empty geodata: ".$addressFrom); 
    } 
    
    // Geocoding API request with end address 
    $geocode_data_end = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address={$formatted_address_to}&key={$GOOGLE_API_KEY}"); 
    $outputTo = json_decode($geocode_data_end); 
    if(!empty($outputTo->error_message)){ 
        die("API Error: ".$outputTo->error_message); 
    }elseif(empty($outputTo->results[0])){ 
        die("Returns empty geodata: ".$addressTo); 
    } 
    
    // Retrieve latitude and longitude from the geodata 
    $latitude_from  = $outputFrom->results[0]->geometry->location->lat; 
    $longitude_from = $outputFrom->results[0]->geometry->location->lng; 
    $latitude_to    = $outputTo->results[0]->geometry->location->lat; 
    $longitude_to   = $outputTo->results[0]->geometry->location->lng; 
    
    // Calculate distance between latitudes and longitudes 
    $theta  = $longitude_from - $longitude_to; 
    $dist   = sin(deg2rad($latitude_from)) * sin(deg2rad($latitude_to)) +  cos(deg2rad($latitude_from)) * cos(deg2rad($latitude_to)) * cos(deg2rad($theta)); 
    $dist   = acos($dist); 
    $dist   = rad2deg($dist); 
    $miles  = $dist * 60 * 1.1515; 
    
    // Get distance in miles 
    $distance = round($miles, 2);

    // Distance in kilometer 
    $distance_km = round($miles * 1.609344, 2);

    // Distance in meter 
    $distance_meter = round($miles * 1609.344, 2);
    
    // Payment according Vehicles 
    $payment_maruti = round($distance_km * 100, 2);
    $payment_alto = round($distance_km * 120, 2);
    $payment_wagonr = round($distance_km * 150, 2);
    $payment_audi = round($distance_km * 200, 2);
    $payment_bmw = round($distance_km * 250, 2);
    $payment_benz = round($distance_km * 300, 2);
}

if(isset($_POST['driver']))
{
    if($_POST['status']=='Busy')
    {
        echo "<script>alert('This Driver is on another Trip. Please select Available Driver');</script>";
    }
    else
    {
        $pickup=$_SESSION['pickup']; 
        $drop=$_SESSION['drop'];
        $distance=$distance_km;
        $pid=$_SESSION['pid'];
        $pname=$_SESSION['pname'];
        $pmobile=$_SESSION['pmobile'];
        $did=$_POST['dID'];
        $dname=$_POST['dName'];
        $dmobile=$_POST['dMobile'];
        $vehicle=$_POST['vehicle'];
        
        if($_POST['vehicle']=="Maruti")
        {
            $payment=$payment_maruti;            
        }
        else if($_POST['vehicle']=="Alto")
        {
            $payment=$payment_alto;
                
        }
        else if($_POST['vehicle']=="Wagon R")
        {
            $payment=$payment_wagonr;               
        }
        else if($_POST['vehicle']=="Audi")
        {
            $payment=$payment_audi;               
        }
        else if($_POST['vehicle']=="BMW")
        {
            $payment=$payment_bmw;               
        }
        else if($_POST['vehicle']=="Benz")
        {
            $payment=$payment_benz;              
        }
        else
        {
            echo "<script>alert('Can not detect the Vehicle');</script>";
        }
        
        $query=mysqli_query($con, "insert into trip(PickupL, DropL, Distance, Payment, PID, PName, PMobileNumber, DID, DName, DMobileNumber, Vehicle) value('$pickup', '$drop', '$distance', '$payment', '$pid', '$pname', '$pmobile', '$did', '$dname', '$dmobile', '$vehicle' )");

        if ($query)
        {
            $query1=mysqli_query($con, "update driver set Status='Busy' where ID='$did'");

            if ($query1)
            {
                $mobileno="94{$pmobile}";
                $message="Hello, Our taxi is booked for you. Driver - {$dname}. Vehicle - {$vehicle}. Mobile - {$dmobile}";

                $base_url = "";
                $api_key = "";

                $configuration = new Configuration(host: $base_url, apiKey: $api_key);
                $api = new SmsApi(config: $configuration);

                $destination = new SmsDestination(to: $mobileno);
                $message = new SmsTextualMessage(destinations: [$destination], text: $message);

                $request = new SmsAdvancedTextualRequest(messages: [$message]);
                $response = $api->sendSmsMessage($request);

                if($response)
                {
                    header('location:booking.php');
                }
                else
                {
                    echo "<script>alert('SMS sending error. Please try again. Thank you!');</script>";
                }
            }
            else
            {
                echo "<script>alert('Update error. Please try again. Thank you!');</script>";
            }
        }
        else
        {
            echo "<script>alert('Insert error. Please try again. Thank you!');</script>";
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>

    <title>Operator Panel | Book Taxi Ride</title>

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
    <li class="active ">Book Taxi Ride</li>
</ul>
</div>
</div>
</div>
</section>

<section class="top-para">
    <div>
        <h6><b>Pickup Location</b>&emsp;>&emsp;<?php echo $_SESSION['pickup'];?></h6>
    </div>
    <div>
        <h6><b>Drop Location</b>&emsp;>&emsp;<?php echo $_SESSION['drop'];?></h6>
    </div>
    <div>
        <h6><b>Distance</b>&emsp;>&emsp;<?php echo $distance_km;?> km</h6>
    </div>
</section>

<section class="w3l-recent-work-hobbies">
    <div class="recent-work">
        <div class="container">
            <div style="text-align: center;">
                <br><br><h5><b>Select a Driver</b></h5><br><br>
            </div>
            <div class="row">
                <?php
                $ret=mysqli_query($con,"select * from driver");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret))
                {
                ?>
                <form method="post">
                <button type="submit" name="driver">
                    <input type="hidden" name="dID" value="<?php echo $row['ID'];?>">
                    <input type="hidden" name="dName" value="<?php echo $row['Name'];?>">
                    <input type="hidden" name="dMobile" value="<?php echo $row['MobileNumber'];?>">
                    <input type="hidden" name="vehicle" value="<?php echo $row['Vehicle'];?>">
                    <h5><?php echo $row['Name'];?></h5> 
                    <h5 style="color: var(--orange);"><?php echo $row['Vehicle'];?></h5>
                    <?php
                    if ($row['Status']=='Available')
                    {
                        ?>
                        <p class="status" style="color: green;">Available</p>
                        <input type="hidden" name="status" value="Available">
                        <?php
                    }
                    else
                    {
                        ?>
                        <p class="status" style="color: red;">Busy</p>
                        <input type="hidden" name="status" value="Busy">
                        <?php
                    }   
                    ?>
                    <?php
                    if ($row['Rating']>0)
                    {
                        ?>
                        <p class="star"><span class="fa fa-star"></span> <?php echo $row['Rating'];?></p>
                        <?php
                    }
                    else
                    {
                        ?>
                        <p class="star">new driver</p>
                        <?php
                    }   
                    ?>
                    <?php
                    if ($row['Vehicle']=="Maruti")
                    {
                        ?>
                        <h5 style="color: gray;"><?php echo $payment_maruti;?> LKR</h5>
                        <?php
                    }
                    else if ($row['Vehicle']=="Alto")
                    {
                        ?>
                        <h5 style="color: gray;"><?php echo $payment_alto;?> LKR</h5>
                        <?php
                    }
                    else if ($row['Vehicle']=="Wagon R")
                    {
                        ?>
                        <h5 style="color: gray;"><?php echo $payment_wagonr;?> LKR</h5>
                        <?php
                    }
                    else if ($row['Vehicle']=="Audi")
                    {
                        ?>
                        <h5 style="color: gray;"><?php echo $payment_audi;?> LKR</h5>
                        <?php
                    }
                    else if ($row['Vehicle']=="BMW")
                    {
                        ?>
                        <h5 style="color: gray;"><?php echo $payment_bmw;?> LKR</h5>
                        <?php
                    }
                    else if ($row['Vehicle']=="Benz")
                    {
                        ?>
                        <h5 style="color: gray;"><?php echo $payment_benz;?> LKR</h5>
                        <?php
                    }
                    else
                    {
                        ?>
                        <h5 style="color: gray;">payment</h5>
                        <?php
                    }   
                    ?>
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