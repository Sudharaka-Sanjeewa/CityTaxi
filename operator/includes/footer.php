<section class="w3l-footer-29-main">
    <div class="footer-29 py-5">
      <div class="container py-lg-4">
        <div class="row footer-top-29">
          <div class="col-lg-4 col-md-6 col-sm-8 footer-list-29 footer-1">
            <h6 class="footer-title-29">Contact Us</h6>
            <ul>
              <?php

$ret=mysqli_query($con,"select * from page where PageType='contactus' ");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              <li>
                <span class="fa fa-map-marker"></span> <p><?php  echo $row['PageDescription'];?>.</p>
              </li>
              <li><span class="fa fa-phone"></span><a href="tel:0777757100"> +<?php  echo $row['MobileNumber'];?></a></li>
              <li><span class="fa fa-envelope-open-o"></span><a href="mailto:info@salons.com" class="mail">
                  <?php  echo $row['Email'];?></a></li><?php } ?>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-4 footer-list-29 footer-2">
  
            <ul>
              <h6 class="footer-title-29">Useful Links</h6>
              <li><a href="../index.php">Home</a></li>
			        <li><a href="../driver-login.php">Driver</a></li>
              <li><a href="../passenger-login.php">Passenger</a></li>
            </ul>
          </div>
         
          <div class="col-lg-4 main-social-footer-29">
          <ul>
            <h6 class="footer-title-29">Social Media</h6>
          </ul>
          <a href="#call" class="call"><span class="fa fa-phone"></span></a>
          <a href="#whatsapp" class="whatsapp"><span class="fa fa-whatsapp"></span></a>
          <a href="#telegram" class="telegram"><span class="fa fa-telegram"></span></a>
          <a href="#facebook" class="facebook"><span class="fa fa-facebook"></span></a>
          <a href="#instagram" class="instagram"><span class="fa fa-instagram"></span></a>
          <a href="#youtube" class="youtube"><span class="fa fa-youtube"></span></a>
          <a href="#linkedin" class="linkedin"><span class="fa fa-linkedin"></span></a>
        </div>

        </div>
      </div>
    </div>
  </section>
  <section class="w3l-footer-29-main w3l-copyright">
    <div class="container">
      <div class="row bottom-copies">
        <p class="col-lg-8 copy-footer-29">© 2024  City Taxi (PVT) Ltd. | all rights reserved</p>
      </div>
    </div>
  </section>