<?php
  session_start();
  include "../settings.php";
  include "../functions.php";
  include "user.php";
  include "image.php";
  include 'validate_form.php';
  include 'event.php';
  include 'slider.php';
  $userid = $_SESSION['id'];
  $username1 = $_SESSION['username'];
  $role = $_SESSION['role'];
  //redirect to login page if theres no session
  if ($username1 == NULL) {
    header('Location: ../login.php');
  }

?>
<!DOCTYPE HTML>
<html>

<head>
  <title>SU | Add Slide</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

  <script
    src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=your_API_key'></script>
  <script src="../style/js/script.js"></script>
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
          Add Slides
        </h2>
        <form enctype="multipart/form-data"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
              method="POST" id="new-user">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $_SESSION['message'] = "";
              $form = new validate_form();
              $newslide = new slider();
              $valid = $form->validate_slide(0);
              if ($valid) {
                if ($newslide->add_slide()) {
                  $_SESSION['message'] = "Slide Successfully Adeed!";
                }
              }
              else {
                $_SESSION['message'] .= "Sorry! Slide cannot be added";
              }
            }
          ?>
          <div class="message">
            <?php
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $_SESSION['message'];
              }
            ?>
          </div>
          <div class="form-group">
            <label class="label" for="content">Content</label>
            <textarea class="form-control" rows="2" id="content"
                      placeholder="Slide Content" name="content" minlength="2"
                      maxlength="85" required
                      onkeyup="countChar(this)"></textarea>
          </div>
          <div id="charNum">0 Charecters</div>
          <div class="form-group">
            <label class="label" for="display">Display</label>
            <select name="display">
              <option value="1">Display</option>
              <option value="2">Hide</option>
            </select>
          </div>
          <div class="form-group">
            <label class="label" for="photo-upload">Upload Main Photo</label>
            <input type="file" class="form-control" id="upload-image""
            name="upload-image" required>
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