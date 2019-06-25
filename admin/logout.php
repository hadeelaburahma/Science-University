<?php
  session_start();
  $username1 = $_SESSION['username'];
  if ($username1 != NULL) {
    $_SESSION = NULL;
    session_destroy();
    header('Location: ../login.php');
  }
  else {
    header('Location: ../login.php');
  }

?>