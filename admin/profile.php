<?php
  session_start();
  $username1 = $_SESSION['username'];
  if ($username1 == NULL) {
    header('Location: ../login.php');
  }
  else {
    if ($username1 == 'loginerror') {
      $_SESSION['username'] = NULL;
      header('Location: ../login.php');
    }
  }
$page = $_SERVER['PHP_SELF'];
$sec = "0";

  include '../functions.php';
  include 'user.php';
  include 'validate_form.php';
  include 'image.php';
  $user = new user();
  $id = $_SESSION['id'];
  $role = $_SESSION['role'];
  $role_name = $user->get_role_name($role);
  $image = $_SESSION['image'];
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>SU | Profile </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <? if ($_SERVER["REQUEST_METHOD"] == "POST") {
              echo "<meta http-equiv='refresh' content='0'>";
              ?>
  <meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
  <script
    type="application/x-javascript"> addEventListener("load", function () {
          setTimeout(hideURLbar, 0);
      }, false);

      function hideURLbar() {
          window.scrollTo(0, 1);
      } </script>
  <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'/>
  <!--<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />-->
  <!-- Custom Theme files -->
  <link href="css/style.css" rel='stylesheet' type='text/css'/>
  <link href="css/font-awesome.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

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


</head>
<body>
<div id="wrapper">
  <!----->
  <?php 
  include 'layout/admin_header.php';
  ?>
  <div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">

      <div class=" profile">
        <div class="profile-bottom">
          <h3><i class="fa fa-user"></i>Profile</h3>
          <div class="profile-bottom-top">
            <div class="profile-bottom-img">
              <img src=<?php global $target_dir;
                print $target_dir . $image; ?> alt="">
            </div>
            <div class="profile-text">
              <h6><?php print ($_SESSION['fullname']); ?></h6>
              <h6 class="role"><?php print ($role_name); ?></h6>
            </div>
          </div>
        </div>

        <form enctype="multipart/form-data"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
              method="POST" id="new-user">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $_SESSION['message'] = "";
              $form = new validate_form();
              $edit_user = new user();
              $valid = $form->validate_updateform_inputs();
              if ($valid) {
                  if (!empty($_FILES['upload-image']['name'])) {
                    $newimage = new image();  
                    $url = $newimage->upload_image($target_dir);
                      if (isset($url)) {
                          $image_id = $newimage->store_image($url, 'profile picture', 2);
                      }
                  } else {
                      $image_id = $edit_user->get_user_imageid($id);
                  }
                  $edit_user->update_user($id,true,$image_id);
                  $_SESSION['message'] = "Successfully Updated!";
                  echo "<meta http-equiv='refresh' content='0'>";         
              } else {
                  $_SESSION['message'] = "Info cannot be updated";
              }
              print ('<div class="message">'.
            $_SESSION['message'].
            '</div>');
          }
          
            $edit_uder = new user();
            ?>
          <div>
            <input type="hidden" id="id" value=<?php echo $id; ?> name="id"
                   class="form-control full-name">
          </div>
          <div class="form-group full-name input2row">
            <label class="label" for="fname">Full Name </label>
            <input type="text" class="form-control full-name" id="fname"
                   value="<?php echo $edit_uder->get_user_fullname($id); ?>"
                   name="fname" minlength="2" required>
          </div>
          <div class="form-group username input2row">
            <label class="label" for="username">Username</label>
            <input type="text" class="form-control username" disabled
                   id="username"
                   value=<?php echo $edit_uder->get_username($id); ?> name="username"
                   minlength="2" required phoneUS>
          </div>
          <div class="form-group">
            <label class="label" for="email">Email Address</label>
            <input type="email" class="form-control" id="email"
                   value=<?php echo $edit_uder->get_user_email($id); ?> name="email"
                   required>
          </div>
          <div class="form-group">
            <label class="label" for="password">Password</label>
            <input type="password" class="form-control" id="password"
                   placeholder="Password" name="password">
          </div>
          <div class="form-group">
            <label class="label" for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password"
                   placeholder="Confirm Password" name="confirm_password">
          </div>

          <div class="form-group">
            <label class="label" for="photo-upload">Upload Photo</label>
            <input type="file" class="form-control" id="upload-image""
            name="upload-image">
          </div>

          <button type="submit" class="btn btn-default submit-btn">Update
          </button>
        </form>

        <!--//gallery-->
        <!---->

      </div>
      <div class="clearfix"></div>
    </div>

    <!---->

    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->

</body>
</html>



