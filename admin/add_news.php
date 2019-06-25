<?php
  include "../settings.php";
  include "../functions.php";
  include "user.php";
  include "image.php";
  include 'validate_form.php';
  include 'article.php';
  session_start();
  $userid = $_SESSION['id'];
  $username1 = $_SESSION['username'];
  $role = $_SESSION['role'];
  ////redirect to login page if theres no session
  if ($username1 == NULL) {
    header('Location: ../login.php');
  }

?>
<!DOCTYPE HTML>
<html>

<head>
  <title>SU | Add News</title>
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
          Add News
        </h2>
        <form enctype="multipart/form-data"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
              method="POST" id="new-user">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $_SESSION['message'] = "";
              $form = new validate_form();
              $newarticle = new article();
              $valid = $form->validate_article_form(1);
              if ($valid) {
                $newarticle->store_article(1, 0);
                $_SESSION['message'] = "Article Successfully Adeed!";
              }
              else {
                $_SESSION['message'] = "Article cannot be added";
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
          <div class="form-group input2row">
            <label class="label" for="title">Title </label>
            <input type="text" placeholder="Article Title" class="form-control"
                   id="title" name="title" minlength="2" required>
          </div>
          <div class="form-group input2row">
            <label class="label" for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date"
                   required>
          </div>
          <div class="form-group input2row">
            <label class="label" for="body">Body</label>
            <textarea id="mytextarea" name="body"></textarea>
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