<?php

  class user {

    private $id = NULL;

    private $username = NULL;

    private $hashed_password = NULL;

    private $role = NULL;

    private $full_name = NULL;

    private $email = NULL;

    private $last_access = NULL;

    public function __construct() {
      db_connect();
    }

    public function __destruct() {
      db_close();
    }

    public function user_exist($username) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $find_user = $conn->prepare('SELECT count(user_id) FROM users WHERE user_name=:user_name');
      $find_user->bindParam(':user_name', $username, PDO::PARAM_STR); //assuming it is a string
      $find_user->execute();
      $result = $find_user->fetchAll(); //make the select
      if ($result[0][0] > 0) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function get_user_id($username) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_id = $conn->prepare('SELECT user_id FROM users WHERE user_name=:user_name');
      $return_id->bindParam(':user_name', $username, PDO::PARAM_STR); //assuming it is a string
      $return_id->execute();
      $result = $return_id->fetchAll();
      $id = ($result[0]['user_id']);
      return $id;
    }

    public function get_hashed_password($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_hash = $conn->prepare('SELECT hashed_password FROM users WHERE user_id=:user_id');
      $return_hash->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_hash->execute();
      $result = $return_hash->fetchAll();
      $hashed_password = ($result[0]['hashed_password']);
      return $hashed_password;
    }

    public function get_user_fullname($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_name = $conn->prepare('SELECT name FROM users WHERE user_id=:user_id');
      $return_name->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_name->execute();
      $result = $return_name->fetchAll();
      $full_name = ($result[0]['name']);
      return $full_name;
    }

    public function get_username($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_name = $conn->prepare('SELECT user_name FROM users WHERE user_id=:user_id');
      $return_name->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_name->execute();
      $result = $return_name->fetchAll();
      $user_name = ($result[0]['user_name']);
      return $user_name;
    }

    public function get_user_email($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_email = $conn->prepare('SELECT email FROM users WHERE user_id=:user_id');
      $return_email->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_email->execute();
      $result = $return_email->fetchAll();
      $email = ($result[0]['email']);
      return $email;
    }

    //get user role as id
    public function get_user_role($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_role = $conn->prepare('SELECT role FROM users WHERE user_id=:user_id');
      $return_role->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_role->execute();
      $result = $return_role->fetchAll();
      $role = ($result[0]['role']);
      return $role;
    }

    //get user role name
    public function get_role_name($role_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_role = $conn->prepare('SELECT role_name FROM roles WHERE role_id=:role_id');
      $return_role->bindParam(':role_id', $role_id, PDO::PARAM_STR); //assuming it is a string
      $return_role->execute();
      $result = $return_role->fetchAll();
      $role = ($result[0]['role_name']);
      return $role;
    }

    public function get_last_access($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_access = $conn->prepare('SELECT last_access FROM users WHERE user_id=:user_id');
      $return_access->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_access->execute();
      $result = $return_access->fetchAll();
      $last_access = ($result[0]['last_access']);
      return $last_access;
    }

    public function get_user_imageid($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_access = $conn->prepare('SELECT user_image FROM users WHERE user_id=:user_id');
      $return_access->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_access->execute();
      $result = $return_access->fetchAll();
      $last_access = ($result[0]['user_image']);
      return $last_access;
    }

    public function get_user_image($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_image = $conn->prepare('SELECT users.user_image,images.url FROM users,images WHERE users.user_id=:user_id and users.user_image=images.image_id');
      $return_image->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_image->execute();
      $result = $return_image->fetchAll();
      foreach ($result as $key => $value) {
        $image[$value['user_image']] = $value['url'];
      }
      return $value['url'];
    }

    public function update_last_access($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $update_access = $conn->prepare('UPDATE users set last_access=now() WHERE user_id=:user_id');
      $update_access->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $update_access->execute();
    }

    public function get_all_roles() {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_roles = $conn->prepare('SELECT role_id,role_name FROM roles');
      $return_roles->execute();
      $result = $return_roles->setFetchMode(PDO::FETCH_ASSOC);
      $result = $return_roles->fetchAll();
      foreach ($result as $key => $value) {
        $role[$value['role_id']] = $value['role_name'];
      }
      return $role;
    }

    public function get_all_users() {
      global $conn;
      $user = [];
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_users = $conn->prepare('select users.user_id, users.name, users.user_name , roles.role_name, date(users.creation_date) as creation_date, date(users.last_access)last_access from users,roles where users.role=roles.role_id');
      $return_users->execute();
      $result = $return_users->setFetchMode(PDO::FETCH_ASSOC);
      $result = $return_users->fetchAll();
      return $result;
    }

    public function store_user() {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $full_name = $_POST['fname'];
      $username = $_POST['username'];
      $email = $_POST["email"];
      $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $role = $_POST["role"];
      try {
        $sql = "INSERT INTO users (name, user_name , email, hashed_password, role, creation_date)
        VALUES ('$full_name' , '$username' ,'$email','$hash','$role',now())";
        //use exec() because no results are returned
        $conn->exec($sql);
        return 1;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return 0;
      }
      return $this->get_user_id($username);
    }

    public function update_user($id, $own, $imageid) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $full_name = $_POST['fname'];
      $email = $_POST["email"];
      $id = $_POST["id"];
      if (!$own) {
        $role = $_POST["role"];
      }
      else {
        $role = $_SESSION['role'];
      }
      if (!empty($_POST['password'])) {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users set  name='$full_name', email='$email', hashed_password='$hash',
                role='$role' , user_image ='$imageid' WHERE user_id=$id";
      }
      else {
        $sql = "UPDATE users set  name='$full_name',  email='$email', role='$role'
                , user_image =$imageid WHERE user_id=$id";
      }
      try {
        //use exec() because no results are returned
        $conn->exec($sql);
        if ($own) {
          $_SESSION['fullname'] = $this->get_user_fullname($id);
          $_SESSION['image'] = $this->get_user_image($id);
        }
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }
    }
  }
