<?php
  include "../settings.php";
  include "../functions.php";
  include "user.php";
  include "image.php";
  include 'validate_form.php';
  session_start();
  $userid = $_SESSION['id'];
  $username1 = $_SESSION['username'];
  $role = $_SESSION['role'];
  $id = $_GET['id'];
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
  $edit_user = new user();
  $userimage = $edit_user->get_user_image($id);
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>SU | Manage Users</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <? if ($_SERVER["REQUEST_METHOD"] == "POST") {
              echo "<meta http-equiv='refresh' content='0'>";
              ?>
  <script type="application/x-javascript">
      addEventListener("load", function () {
          setTimeout(hideURLbar, 0);
      }, false);

      function hideURLbar() {
          window.scrollTo(0, 1);
      }
  </script>
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
          Welcome
          <?php print($_SESSION['fullname']); ?>
        </h2>
      </div>
      <!--//banner-->
      <div class="banner new-user-form">
        <h2>
          Edit User
        </h2>
        <div class="profile-bottom-img user-img">
              <img class ="img-circle" src=<?php global $target_dir;
                print $target_dir . $userimage; ?> alt="">
            </div>
        <form enctype="multipart/form-data"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>"
              method="POST" id="new-user">
              <?php
              $_SESSION['message'] = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $form = new validate_form();
              
              $valid = $form->validate_updateform_inputs();
              if ($valid) {
                      $image_id = $edit_user->get_user_imageid($id);
                  $edit_user->update_user($id,false,$image_id);
                  $_SESSION['message'] = "Successfully Updated!";
                  echo "<meta http-equiv='refresh' content='0'>";         
              } else {
                  $_SESSION['message'] = "Info cannot be updated";
              }
            if(isset($_SESSION['message'])){
              print ('<div class="message">'.
            $_SESSION['message'].
            '</div>');
            }
          }
            ?>
          <div>
            <input type="hidden" id="id" value=<?php echo $id; ?> name="id"
                   class="form-control
                            full-name">
          </div>
          <div class="form-group full-name input2row">
            <label class="label required" for="fname">Full Name </label>
            <input type="text" class="form-control full-name" id="fname"
                   value="<?php echo $edit_user->get_user_fullname($id); ?>"
                   name="fname" minlength="2" required>
          </div>
          <div class="form-group username input2row">
            <label class="label" for="username">Username</label>
            <input type="text" class="form-control username" disabled
                   id="username"
                   value=<?php echo $edit_user->get_username($id); ?> name="username"
                   minlength="2" required phoneUS>
          </div>
          <div class="form-group">
            <label class="label required" for="email">Email Address</label>
            <input type="email" class="form-control" id="email"
                   value=<?php echo $edit_user->get_user_email($id);
                   ?> name="email" required>
          </div>
          <div class="form-group">
            <label class="label" for="password">Password</label>
            <input type="password" class="form-control" id="password"
                   placeholder="Password" name="password">
          </div>
          <div class="form-group">
            <label class="label" for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password"
                   placeholder="Confirm Password"
                   name="confirm_password">
          </div>
          <div class="form-group">
            <label class="label required" for="role">User Role</label>
            <select name="role"
                    value=<?php echo $edit_user->get_user_role($id); ?>>
              <?php
                get_roles_options();
              ?>
            </select>
          </div>
          <button type="submit" class="btn btn-default submit-btn">Update
          </button>
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