<?php
class contact {
  private $contact_info;
    public function __construct() {
      db_connect();
    }

    public function __destruct() {
      db_close();
    }
    function store_contact_message() {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $fname = $_POST["fname"];
      $email = $_POST["email"];
      $phone = $_POST["phone"];
      $message = $_POST["message"];
      try{
        $sql = "INSERT INTO contact_form (full_name, email , phone_number, message, submission_date, flag)
        VALUES ('$fname' , '$email' , '$phone' , '$message' , NOW(),'new')";
        //use exec() because no results are returned
        $conn->exec($sql);
        return 1;
      }
      catch (PDOException $e) {
        echo $e->getMessage();
        return 0;
      }
    }

    public function get_all_messages($flag) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try{
        if($flag == 0){
          $return_messages = $conn->prepare('SELECT * FROM contact_form order by submission_date desc');  
        }
        else {
          $return_messages= $conn->prepare("SELECT * FROM contact_form WHERE flag= $flag order by submission_date desc");
        }
        
          $return_messages->execute();
          $result = $return_messages->fetchAll();
          //var_dump($result);die;
        return $result;
      }
      catch (PDOException $e) {
        echo $e->getMessage();
        return null;
      }
    }
    public function get_message($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try{
         $return_message = $conn->prepare('SELECT full_name, email,phone_number,message,submission_date,flag
          FROM contact_form where id=:id');
          $return_message->bindParam(':id', $id, PDO::PARAM_STR); //assuming it is a string
          $return_message->execute();
          $result = $return_message->fetchAll();
          return $result;
      }
      catch (PDOException $e) {
        echo $e->getMessage();
        return null;
      }
    }

    public function update_flag($id,$auto) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try{
        if($auto){
          $update_flag = $conn->prepare("update contact_form set flag= 2 WHERE id= $id"); 
        }
        else{
          $flag = $_POST['flag'];
         $update_flag = $conn->prepare("update contact_form set flag= $flag WHERE id= $id");
        } 
         $update_flag->execute();
          $_SESSION['message'] = "Done!";
          return 1;
      }
      catch (PDOException $e) {
        echo $e->getMessage();
        $_SESSION['message'] = "Cannot Be Added!";
        return 0;
      }
    }
}
?>