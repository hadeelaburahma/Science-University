<?php
include "functions.php";
include "settings.php";
include "admin/contact.php";
$new_message = new contact ();
if(isset($_POST['message'])){
  $new_message->store_contact_message();
}
else{
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    include_once "layout/head.html";
  ?>
  <title>SU | Thank You</title>
</head>

<body>
<?php
  include_once "layout/header.php";
?>

<!--end of header-->
<div class="body-content">
  <div class="inner-image">
    <div class="container-fluid">
      <div class="row">
        <img src="images/innerimg.jpg">
        <div class="inner-text">
          <p> Thank You For contacting us! </p>
        </div>
      </div>
    </div>
  </div>
  <!--end of main image-->
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="dummy">
          <p> We will responde as soon as possible </p>
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
  include_once "layout/footer.php";
?>

</body>

</html>