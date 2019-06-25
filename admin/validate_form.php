<?php

  class validate_form {

    private $input = '';

    private $full_name = '';

    private $message = "";

    public function validate_fullname() {
      $message = "";
      if (empty($_POST["fname"])) {
        $message .= "Full Name is Required <br>";
      }
      else {
        $fullName = $_POST['fname'];
        $fullName = trim($fullName);
        $fullName = stripslashes($fullName);
        $fullName = htmlspecialchars($fullName);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $fullName)) {
          $message .= "Full Name should only contain letters and white spaces <br>";
        }
        else {
          if (strlen($fullName) > 60) {
            $message .= "Full Name length should not exeed 60 char.<br>";
          }
        }
      }
      $_SESSION['message'] = $message;
      if ($message = "") {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function validate_username() {
      $message = "";
      if (empty($_POST["username"])) {
        $message .= 'User Name is Required';
      }
      else {
        $userName = $_POST['username'];
        $userName = trim($userName);
        $userName = stripslashes($userName);
        // check if username start with letter and only contains letters,numbers and underscore
        if (!preg_match("/^([a-zA-Z])+([a-zA-Z0-9\._-])*$/", $userName)) {
          $message .= "Username should start with letter and should only contain letters,numbers and _ - <br>";
        }
        else {
          if (strlen($userName) > 60) {
            $message .= "Username length should not exeed 60 char.<br>";
          }
        }
        $user = new user();
        if ($user->user_exist($userName)) {
          $message .= "Username already exists <br>";
        }
      }
      $_SESSION['message'] .= $message;
      if ($message = "") {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function validate_email() {
      $message = "";
      if (empty($_POST["email"])) {
        $message .= 'Email is Required';
      }
      else {
        $email = $_POST['email'];
        $email = trim($email);
        $email = stripslashes($email);
        // check if username start with letter and only contains letters,numbers and underscore
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $message .= "Invalid Email <br>";
        }
      }
      $_SESSION['message'] .= $message;
      if ($message = "") {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function match_passwords() {
      $message = "";
      if (empty($_POST["password"])) {
        $message .= "Password is Required <br>";
      }
      else {
        $password = $_POST['password'];
      }
      if (empty($_POST["confirm_password"])) {
        $message .= "You should re-enter Password <br>";
      }
      else {
        $cpassword = $_POST['confirm_password'];
      }
      if ($password == $cpassword) {
        $_SESSION['message'] .= $message;
        return TRUE;
      }
      else {
        $message .= "Passwords don't match,";
        $_SESSION['message'] .= $message;
        return FALSE;
      }

    }

    public function validate_article_title() {
      $message = "";
      if (empty($_POST["title"])) {
        $message .= "Title is Required <br>";
      }
      else {
        $title = $_POST['title'];
        $title = trim($title);
        // check if t only contains letters and whitespace
        if (strlen($title) > 255) {
          $message .= "Title should not exeed 250 char.<br>";
        }
      }
      if ($message = "") {
        return TRUE;
      }
      else {
        $_SESSION['message'] .= $message;
        return FALSE;
      }
    }

    public function validate_article_body() {
      $message = "";
      if (empty($_POST["body"])) {
        $message .= "Body is Required <br>";
      }
      else {
        $body = $_POST['body'];
        // check body length is at least 255 char
        if (strlen($body) < 255) {
          $message .= "Body is too short.<br>";
        }
      }
      $_SESSION['message'] .= $message;
      if ($message = "") {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function validate_article_image() {
      $message = "";
      if (empty($_FILES["upload-image"]["name"])) {
        $message .= "You should upload am image for your article <br>";
      }
      $_SESSION['message'] = $message;
      if ($message = "") {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function validate_article_date($type) {
      $message = "";
      //check news date
      if($type == 1){
      if (empty($_POST["date"])) {
        $message .= "Date cannot be emptye <br>";
      }
      else {
        $date_array = explode('/', $_POST['date']);
        if (count($date_array) == 3) {
          if (checkdate($date_array[0], $date_array[1], $date_array[2])) {
            $message .= 'Invalid date format <br>';
          }
        }
      }
    }
    //check events dates
    else {
      if($type == 2){
        if (empty($_POST["startdate"]) 
        || empty($_POST["enddate"])) {
          $message .= "Date cannot be emptye <br>";
        }
        else {
              if(strcmp($_POST['startdate'] , $_POST['enddate'])>=0){
                $message .= "Start Date cannot be after End Date!";
              }
            }
          }
      if ($message = "") {
        return TRUE;
      }
      else {
        $_SESSION['message'] .= $message;
        return FALSE;
      }
    }
  }

    public function validate_form_inputs() {
      $this->validate_fullname();
      $this->validate_username();
      $this->validate_email();
      $this->match_passwords();
      if ($_SESSION['message'] == "") {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function validate_updateform_inputs() {
      $this->validate_fullname();
      $this->validate_email();
      if (!empty($_POST['password'])) {
        $this->match_passwords();
      }
      if ($_SESSION['message'] == "") {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }
    public function validate_article_form($type) {
      if($type==1){
        if($this->validate_article_title() &&
        $this->validate_article_date($type)){
           return 1;
        }
        else {
          return 0;
        }
      }
      //validate events
      if ($type == '2') { 
        if($this->validate_article_title() &&
        $this->validate_article_date($type)){
          return 1;
        }
        else {
          return 0;
        }
      }
    }

    public function validate_slide($update) {
      $message = "";
      if (empty($_POST["content"])) {
        $message .= "Content is Required <br>";
      }
      else {
        $content = $_POST['content'];
        $content = trim($content);
        // check that length is not more than 85 char
        if (strlen($content) > 86) {
          $message .= "Content should not exeed 85 char.<br>";
        }
        //Check display field is set
        else {
          if (empty($_POST["display"])) {
            $message .= "Please Choose whether to display this slide or not!";

          }
          if ($update) {
            if (!empty($_FILES['upload-image']['name'])) {
              $this->validate_article_image();
            }
          }
          $_SESSION['message'] .= $message;
          if ($_SESSION['message'] == "") {
            return TRUE;
          }
          else {
            return FALSE;
          }

        }
      }
    }

    public function validate_menu_items($menu_id) {
      $message = "";
      $menu1 = new menu();
      $items = count($menu1->get_menu_items($menu_id));
      //Check number of elements in main-menu is not more than 6 elements
      if (($menu_id == 3 || $menu_id == 5) && $items >= 6) {
        $message .= 'You Cannot Add More Items';
        return 0;
      }
      else {
        return 1;
      }
    }
  }
