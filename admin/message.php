<?php
  include "../settings.php";
  include 'user.php';
  include '../functions.php';
  include 'article.php';
  include 'slider.php';
  include 'contact.php';
  $contact_message = new contact();
  if(!isset($_GET['id'])){
    header('location:contact_messages.php');
  }
  else 
  {
    $message_id = $_GET['id'];
  }
  session_start();
  $username = $_SESSION['username'];
  $role = $_SESSION['role'];
  //redirect to login page if theres no session
  if ($username == NULL) {
    header('Location: ../login.php');
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>SU | Message</title>
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
          Welcome <?php print($_SESSION['fullname']);
          ?>
        </h2>
      </div>
      <!--//banner-->
      <div class="banner">
        <h2>
          Message
        </h2>
      </div>
<?php 
  $message = $contact_message->get_message($message_id);
  $flag = $message[0]['flag'];
  if($flag=="new"){
    $flag='viewd';
    $contact_message->update_flag($message_id,1);
  }
  ?>
  <div class="banner">
        <h2 class="title">
          Full Name: 
        </h2>
        <h2 class="message-info"> <?php print($message[0]['full_name']);?>
        </h2>
  </div>
    <div class="banner">
        <h2 class="title">
          Email: 
        </h2>
        <h2 class="message-info">
          <?php print($message[0]['email']);
          ?>
        </h2>
    </div>
    <div class="banner">
        <h2 class="title">
          Phone Number:
        </h2>
        <h2 class="message-info">
        <?php print($message[0]['phone_number']);?>
        </h2>
    </div>
    <div class="banner">
        <h2 class="title">
          Message: <a title="reply" href="mailto:<?php print($message[0]['email']);?>?Subject=Reply"><span class="fa fa-reply"></span></a>
        </h2>
        <h2 class="message-info">
        <?php print($message[0]['message']);
          ?>
        </h2>
      </div>
  <div class="banner">
    <form enctype="multipart/form-data"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $message_id; ?>"
              method="POST" id="new-user">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $_SESSION['message'] = "";
              $contact_message->update_flag($message_id,0);
              }
          ?>
  <select name="flag">
    <option value="3" <?php if($flag=="to-be-replied")echo "selected";?>>To be replied</option>
    <option value="2" <?php if($flag=="viewd")echo "selected";?>>Viewed</option>
    <option value="4" <?php if($flag=="replied")echo "selected";?>>Replied</option>
    <option value="5"<?php if($flag=="ignored")echo "selected";?>>Ignored</option>
</select>
</div>
<button type="submit" class="btn btn-default submit-btn">Save</button>
  </form>
  

      <!---->
      <!--scrolling js-->
      <script src="js/jquery.nicescroll.js"></script>
      <script src="js/scripts.js"></script>
      <!--//scrolling js-->
      <script src="js/bootstrap.min.js"></script>
</body>
</html>