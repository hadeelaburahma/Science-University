<?php
  include "../settings.php";
  include "../functions.php";
  include "user.php";
  include "image.php";
  include 'validate_form.php';
  include 'menu.php';
  session_start();
  $userid = $_SESSION['id'];
  $username1 = $_SESSION['username'];
  $role = $_SESSION['role'];
  if (!empty(($_GET['id']))) {
    $menu_id = $_GET['id'];
    $menu = new menu();
    $items = $menu->get_menu_items($menu_id);
  }
  else {
    header('location:edit_menus.php');
  }
  //redirect to login page if theres no session
  if ($username1 == NULL) {
    header('Location: ../login.php');
  }

?>
<!DOCTYPE HTML>
<html>

<head>
  <title>SU | Edit Menu</title>
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
          Edit <?php print $menu->get_menu_name($menu_id); ?>
        </h2>
        <!-- <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $menu_id; ?>" method="POST" id="edit-menu"> -->
        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION['message'] = "";
            $item_id = $_POST['item-id'];
            $action = $_POST['submit-btn'];
            if ($action == "update") {
              $menu->update_menu($item_id);
              $_SESSION['message'] = "Successfully Updated!";
              print "<meta http-equiv='refresh' content='0'>";
            }
            else {
              $menu->delete_menu($item_id);
              $_SESSION['message'] = "Successfully Deleted!";
              print "<meta http-equiv='refresh' content='0'>";
            }
          }
          else {
            $_SESSION['message'] = "Article cannot be added";
          }
        ?>
        <div class="message">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              echo $_SESSION['message'];
            }
          ?>
        </div>

        <?php
          foreach ($items as $key => $value) {
            print('<div class="row">
                          <form enctype="multipart/form-data" action="/admin/editmenu.php?id=' . $_GET['id'] . '" method="POST" id="edit-menu">
                          <div class="col-sm-4">
                          <input type="hidden" value="' . $value['id'] . '"class="form-control" id="item-id" name="item-id"  required>
                          <div class="form-group input2row">
                          <label class="label required" for="item">Title ' . ($key + 1) . '</label>
                          <input type="text" value="' . $value['title'] . '"class="form-control" id="title" name="title" required>
                          </div>
                          </div>');
            print('<div class="col-sm-4">
                            <div class="form-group input2row">
                            <label class="label" for="item">Link ' . ($key + 1) . '</label>
                            <input type="text" value="' . $value['link'] . '"class="form-control" id="title" name="link" >
                            </div>
                            </div>
                            ');
            if ($menu_id == 5 || $menu_id == 8) {
              print('<div class="col-sm-4">
                                <div class="form-group input2row">
                                <label class="label" for="item">Class ' . ($key + 1) . '</label>
                                <input type="text" value="' . $value['class'] . '"class="form-control" id="social-class" name="social-class" >
                                </div>
                                </div>');
            }
            print('
                               <button type="submit" name="submit-btn" value="update" class="btn btn-default submit-btn">Save</button>
                                <button type="submit" name="submit-btn" value="delete" class="btn btn-default submit-btn">Delete</button>
                                </form>
                                </div>');
          }

        ?>
      </div>
    </div>
    </div>
      <div class="add-new"><a href="add_menu.php?parent=<?php print $menu_id;?>"><i class="fa fa-plus"> Add Another Element</i></a>
    </div>


    <!---->
    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>