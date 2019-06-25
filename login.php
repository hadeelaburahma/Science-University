<?php
  session_start();
  $username1 = "";
  if (isset($_SESSION['username'])) {
    $username1 = $_SESSION['username'];
    if ($username1 != 'loginerror') {
      header('Location: admin/index.php');
    }
  }

  //include 'functions.php';
  include 'settings.php';
  include 'admin/user.php';
  include 'admin/image.php';
  include 'admin/article.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    include_once 'layout/head.html';
  ?>
  <title>SU | Log in</title>
  <link href="style/css/login.css" rel="stylesheet">
</head>

<body>
<?php
  // include_once 'layout/header.php';
?>
<!--end of header-->
<div class="body-content">
  <div class="inner-image">
    <div class="container-fluid">
      <div class="row">
        <img src="images/innerimg.jpg">
        <div class="inner-text">
          <p>Log in</p>
        </div>
      </div>
    </div>
  </div>
  <!--end of main image-->
  <div class="container">
    <?php
      include 'functions.php';
      if ($username1 == 'loginerror') {
        display_login_error();
        $_SESSION['username'] = NULL;
      }
    ?>
    <div class="error_message"><p><span
          class="fas fa-exclamation-triangle"></span> Unrecognized username
        and/or password!</p></div>
    <form class="login-form" action="admin/check.php" method="post">
      <div class="row">
        <label class="login-label" for="username">Username</label>
      </div>
      <div class="row">
        <input class="login-input" type="text" placeholder="Enter Username"
               name="username" required>
      </div>

      <div class="row">
        <label class="login-label" for="password">Password</label>
      </div>
      <div class="row">
        <input class="login-input" type="password" placeholder="Enter Password"
               name="password" required></br>
      </div>
      <div class="row">
        <button class="submit-btn" type="submit">Log in</button>
      </div>
      <div class="row">
        <label class="remember">
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>
    </form>
  </div>
</div>
<!--end of body contents-->
</body>

</html>