<?php
  include "../settings.php";
  include "image.php";
  include '../functions.php';
  include 'validate_form.php';
  include 'user.php';
  $new_image = new image();
  session_start();
  $username1 = $_SESSION['username'];
  $role = $_SESSION['role'];
  ////redirect to login page if theres no session
  if ($username1 == NULL) {
    header('Location: ../login.php');
  }
  //redirect to dashboard home if the user is not the super user
  else {
    if ($role != 1) {
      header('Location: index.php');
    }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>SU | Manage Users</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <script
    type="application/x-javascript"> addEventListener("load", function () {
          setTimeout(hideURLbar, 0);
      }, false);

      function hideURLbar() {
          window.scrollTo(0, 1);
      } </script>
  <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'/>
  <!-- Custom Theme files -->
  <link href="css/style.css" rel='stylesheet' type='text/css'/>
  <link href="css/font-awesome.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <!-- Mainly scripts -->
  <script src="js/jquery.metisMenu.js"></script>
  <script src="js/jquery.slimscroll.min.js"></script>
  <!-- Custom and plugin javascript -->
  <link href="css/custom.css" rel="stylesheet">
  <script src="js/custom.js"></script>
  <script src="js/screenfull.js"></script>
  <script>
      $(function () {
          $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

          if (!screenfull.enabled) {
              return false;
          }


          $('#toggle').click(function () {
              screenfull.toggle($('#container')[0]);
          });


      });
  </script>

  <!----->

  <!--pie-chart--->
  <script src="js/pie-chart.js" type="text/javascript"></script>
  <!--skycons-icons-->
  <script src="js/skycons.js"></script>
  <!--//skycons-icons-->
</head>
<body>
<div id="wrapper">
  <!----->
  <?php 
  include 'layout/admin_header.php';
  ?>
  <div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">

      <!--banner-->
      <div class="banner">
        <h2>
          Welcome <?php print ($_SESSION['fullname']);
          ?>
        </h2>
      </div>
      <!--//banner-->
      <div class="banner new-user-form">
        <h2>
          Add New User
        </h2>
        <form enctype="multipart/form-data"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
              method="POST" id="new-user">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $form = new validate_form();
              $valid = $form->validate_form_inputs();
              if ($valid == TRUE) {
                $newuser = new user();  
                if($newuser->store_user())
                  $new_user_id = $newuser->get_user_id($_POST['username']);
                  $_SESSION['message'] = "Succefully Added";
              }
            if($_SESSION['message'] != ""){
              print('<div class="message">'.$_SESSION['message'].
              '</div>');
            }
          }
            ?>
          <div class="form-group full-name input2row">
            <label class="label required" for="fname">Full Name </label>
            <input type="text" class="form-control full-name" id="fname"
                   placeholder="Full Name" name="fname" minlength="2" required>
          </div>
          <div class="form-group username input2row">
            <label class="label required" for="username">Username</label>
            <input type="text" class="form-control username" id="phone"
                   placeholder="Username" name="username" minlength="2" required
                   phoneUS>
          </div>
          <div class="form-group">
            <label class="label required" for="email">Email Address</label>
            <input type="email" class="form-control" id="email"
                   placeholder="Email" name="email" required>
          </div>
          <div class="form-group">
            <label class="label required" for="password">Password</label>
            <input type="password" class="form-control" id="password"
                   placeholder="Password" name="password" required>
          </div>
          <div class="form-group">
            <label class="label required" for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password"
                   placeholder="Confirm Password" name="confirm_password"
                   required>
          </div>
          <div class="form-group">
            <label class="label required" for="role">User Role</label>
            <select name="role">
              <?php
                get_roles_options();
              ?>
            </select>
          </div>

          <button type="submit" class="btn btn-default submit-btn">Add</button>
        </form>
      </div>


      <!---->
      <!--scrolling js-->
      <script src="js/jquery.nicescroll.js"></script>
      <script src="js/scripts.js"></script>
      <!--//scrolling js-->
      <script src="js/bootstrap.min.js"></script>
</body>
</html>