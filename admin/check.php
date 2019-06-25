<?php
  session_start();
  include '../functions.php';
  include 'user.php';
  //new object from class users
  $user = new user();
  $entered_username = $_POST['username'];
  $entered_password = $_POST['password'];
  //check if username and password are correct
  if ($user->user_exist($entered_username)) {
    $id = $user->get_user_id($entered_username);
    $hashed_password = $user->get_hashed_password($id);
    $check_password = password_verify($entered_password, $hashed_password);
    if ($check_password) {
      if ($user->get_user_role($id) != 3) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $entered_username;
        $_SESSION['role'] = $user->get_user_role($id);
        $_SESSION['fullname'] = $user->get_user_fullname($id);
        $_SESSION['image'] = $user->get_user_image($id);
        header('Location:index.php');
      }
      else {
        $_SESSION['username'] = 'loginerror';
        header('Location: ../login.php');
      }
    }
    else {
      $_SESSION['username'] = 'loginerror';
      header('Location: ../login.php');
    }
  }
  else {
    $_SESSION['username'] = 'loginerror';
    header('Location: ../login.php');
  }
?>