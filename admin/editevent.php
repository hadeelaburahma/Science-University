<?php
session_start();
include "../settings.php";
include "../functions.php";
include "user.php";
include "image.php";
include 'validate_form.php';
include 'event.php';
$userid = $_SESSION['id'];
$username1 = $_SESSION['username'];
$role = $_SESSION['role'];
//redirect to login page if theres no session
if ($username1 == null) {
    header('Location: ../login.php');
}
$event = new event();
$event_id = $_GET['id'];
$article_id = $event->get_eventarticle_id($event_id);
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>SU | Edit Event</title>
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
          <?php print($_SESSION['fullname']);?>
        </h2>
      </div>
      <!--//banner-->
      <div class="banner new-user-form">
        <h2>
          Edit Event
        </h2>
        <form enctype="multipart/form-data"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $event_id; ?>"
              method="POST" id="new-user">
          <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['message'] = "";
    $form = new validate_form();
    $newimage = new image();
    $newevent = new event();
    $valid = $form->validate_article_form(2);
    if ($valid) {
        if (!empty($_FILES['upload-image']['name'])) {
            $url = $newimage->upload_image($articles_images);
            if (isset($url)) {
                $image_id = $newimage->store_image($url, 'events', 2);
            }
        } else {
            $image_id = $newevent->get_event_imageid($event_id);
        }
        $newevent->update_event($event_id, $image_id);
        $_SESSION['message'] = "Article Successfully Updated!";
    } else {
        $_SESSION['message'] = "Article cannot be added";
    }
}
?>
          <div class="message">
            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  print "<meta http-equiv='refresh' content='0'>";
    echo $_SESSION['message'];
}
?>
          </div>
          <div class="form-group input2row">
            <label class="label" for="title">Title </label>
            <input type="text"
                   value="<?php print $event->get_article_title($article_id);?>"
                   class="form-control" id="title" name="title" minlength="2"
                   required>
          </div>
          <div class="form-group input2row">
            <label class="label" for="date">Start Date</label>
            <input type="datetime-local" class="form-control"
                   value="<?php print $event->get_event_date($event_id, 'start_date');?>"
                   id="date" name="startdate" required>
          </div>
          <div class="form-group input2row">
            <label class="label" for="date">End Date</label>
            <input type="datetime-local" class="form-control"
                   value="<?php print $event->get_event_date($event_id, 'end_date');?>"
                   id="enddate" name="enddate" required>
          </div>
          <div class="form-group">
            <label class="label" for="location">Location</label>
            <select name="location" value="Zarqa">
              <option value="Amman">Amman</option>
              <option value="Zarqa">Zarqa</option>
              <option value="Irbid">Irbid</option>
              <option value="Ajlun">Ajlun</option>
              <option value="Al-Karak">Al-Karak</option>
              <option value="Aqaba">Aqaba</option>
              <option value="Ramtha">Ramtha</option>
              <option value="Maan">Maan</option>
              <option value="Tafilah">Tafilah</option>
              <option value="Salt">Salt</option>
              <option value="Jerash">Jerash</option>
            </select>
          </div>
          <div class="form-group input2row">
            <label class="label" for="body">Body</label>
            <textarea id="mytextarea"
                      name="body"><?php print $event->get_article_body($article_id);?></textarea>
          </div>
          <div class="form-group">
            <label class="label" for="photo-upload">Upload Main Photo</label>
            <input type="file" class="form-control" id="upload-image" name="upload-image">
          </div>
          <div class="form-group">
            <label class="label" for="status">Status</label>
            <select name="status">
              <?php get_status_options(2);?>
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