<?php
  include "../settings.php";
  include 'user.php';
  include '../functions.php';
  include 'article.php';
  include 'slider.php';
  include 'contact.php';
  $messages = new contact();
  if(!isset($_GET['flag'])){
    $_GET['flag']=0;
  }
  session_start();
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
  <title>SU | Contact Messages</title>
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
          Contact Messages
        </h2>
      </div>
      <div class="banner edit-users-table">
      <form enctype="multipart/form-data"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
              method="GET" id="new-user"> 
<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET"){
  $flag = $_GET['flag'];
  $contact_messages = $messages->get_all_messages($flag);
}
  ?>
<select name="flag" onchange="this.form.submit()">
    <option value="0" <?php if($flag==0)echo "selected";?>>All</option>
    <option value="1" <?php if($flag==1)echo "selected";?>>New</option>
    <option value="3" <?php if($flag==3)echo "selected";?>>To be replied</option>
    <option value="2" <?php if($flag==2)echo "selected";?>>Viewed</option>
    <option value="4" <?php if($flag==4)echo "selected";?>>Replied</option>
    <option value="5"<?php if($flag==5)echo "selected";?>>Ignored</option>
</select>
</form>
        <table class="table table-striped">
          <thead>
          <th></th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Flag</th>
          <th>Submission Date</th>
          </thead>
          <tbody>
          <?php
            foreach ($contact_messages as $value) {
              print('<a href="message.php?id=' . $value["id"] . '"> <tr>
        <td> <a href="message.php?id=' . $value["id"] . '"><i class="fa fa-eye"></i></td>
        <td>' . $value["full_name"] . '</td>
        <td>' . $value["email"] . '</td>
        <td>' . $value["phone_number"] . '</td>
        <td>' . $value["flag"] . '</td>
        <td>' . $value["submission_date"] . '</td>
        </tr>');
            }
          ?>    </tbody>
          </a>
        </table>
      </div>

      <!---->
      <!--scrolling js-->
      <script src="js/jquery.nicescroll.js"></script>
      <script src="js/scripts.js"></script>
      <!--//scrolling js-->
      <script src="js/bootstrap.min.js"></script>
</body>
</html>