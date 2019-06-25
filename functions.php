<?php
  include 'settings.php';
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  function db_connect() {
    global $conn, $servername, $username, $password, $dbname;
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  function db_close() {
    global $conn;
    $conn = NULL;
  }

  function display_login_error() {
    echo '<style type="text/css">
	.error_message {
		display: block;
	}
	</style>';
  }

  function get_roles_options() {
    $user = new user();
    $roles = $user->get_all_roles();
    $selected = $user->get_user_role($_GET['id']);
    foreach ($roles as $role_id => $role_name) {
      if ($role_id == $selected) {
        print_r("<option  selected='selected' value=$role_id> $role_name" . "</option>");
      }
      else {
        print_r("<option  value=$role_id> $role_name" . "</option>");
      }
    }
  }

  function get_status_options($type) {
    $article = new article();
    $statuses = $article->get_all_statuses($type);
    if($type==1){
    $selected = $article->get_article_status($_GET['id']);
    }
    else{
      $event = new event();
      $article_id = $event->get_eventarticle_id($_GET['id']);
      $selected = $event->get_article_status($article_id);
    }
    foreach ($statuses as $key => $value) {
      if ($selected == $value['status']) {
        print "<option selected='selected' value='$key+1'>" . $value['status'] . "</option>";
      }
      else {
        print "<option value='$key+1'>" . $value['status'] . "</option>";
      }
    }
  }