<?php
  include 'functions.php';
  include 'settings.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    include_once 'layout/head.html';
  ?>
  <title>SU | About</title>
</head>

<body>
<?php
  include_once 'layout/header.php'; ?>
<!--end of header-->
<div class="body-content">
  <div class="inner-image">
    <div class="container-fluid">
      <div class="row">
        <img src="images/innerimg.jpg">
        <div class="inner-text">
          <p>About Us</p>
        </div>
      </div>
    </div>
  </div>
  <!--end of main image-->
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="dummy">
          <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip ex ea commodo consequat. Duis aute irure dolor in
            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
            culpa qui officia deserunt mollit anim id est laborum."

          </p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="find-uss">
          <ul class="find-us-list">
            <div class="ul-header">
              <h4>How to find us</h4>
            </div>
            <li class="phone-icon"> +1 (408) 703 8738</li>
            <li class="phone-icon">+962 6 581 7612</li>
            <li><span class="fa fa-envelope"></span>info@ScienceUniversity.edu
            </li>
            <li><i class="fa fa-envelope"></i>Contact us</li>
            <li><i class="fa fa-map-marker"></i>find us</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end of body contents-->
<?php
  include_once 'layout/footer.php';
?>
<!--end of bottom footer-->
</body>

</html>