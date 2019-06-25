<?php
  include "../settings.php";
  include 'user.php';
  include '../functions.php';
  include 'event.php';
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
  <title>SU | Edit Events</title>
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
          Edit Events
        </h2>
      </div>
      <div class="banner edit-users-table">
        <table class="table table-striped">
          <thead>
          <th></th>
          <th>Title</th>
          <th>Status</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Location</th>
          </thead>
          <tbody>
          <?php
            $event = new event();
            $events = $event->get_all_events();
            foreach ($events as $value) {
              print('<a href="editevent.php?id=' . $value["event_id"] . '"> <tr>
        <td> <a href="editevent.php?id=' . $value["event_id"] . '"><i class="fa fa-edit"></i></td>
        <td>"' . $value["title"] . '</td>
        <td>' . $value["status"] . '</td>
        <td>' . $value["start_date"] . '</td>
        <td>' . $value["end_date"] . '</td>
        <td>' . $value["location"] . '</td>
        </tr>');
            }
          ?>    </tbody>
          </a>
        </table>
      </div>
      <div class="add-new"><a href="add_events.php"><i class="fa fa-plus"> Add Another Event</i></a>
    </div>

      <!---->
      <!--scrolling js-->
      <script src="js/jquery.nicescroll.js"></script>
      <script src="js/scripts.js"></script>
      <!--//scrolling js-->
      <script src="js/bootstrap.min.js"></script>
</body>
</html>