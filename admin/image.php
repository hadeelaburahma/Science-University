<?php

  class image {

    private $image_id;

    private $user_id;

    private $added_date;

    private $title;

    private $url;

    private $status;

    public function get_image_id($url) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_id = $conn->prepare('SELECT image_id FROM images WHERE url=:url');
      $return_id->bindParam(':url', $url, PDO::PARAM_STR); //assuming it is a string
      $return_id->execute();
      $result = $return_id->fetchAll();
      $id = $result[0]['image_id'];
      return $id;
    }

    public function get_image_url($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_url = $conn->prepare('SELECT url FROM images WHERE image_id=:image_id');
      $return_url->bindParam(':image_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_url->execute();
      $result = $return_url->fetchAll();
      $url = ($result[0]['url']);
      return $url;
    }

    public function get_image_status($id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_status = $conn->prepare('SELECT status FROM images WHERE image_id=:image_id');
      $return_status->bindParam(':image_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_status->execute();
      $result = $return_status->fetchAll();
      $status = ($result[0]['status']);
      return $status;
    }

    public function upload_image($dir) {
      $file_name = substr(md5(rand(1, 213213212)), 1, 5) . "_" . str_replace([
        '\'',
        '"',
        ' ',
        '`',
      ], '_', $_FILES['upload-image']['name']);
      $target_file = $dir . $file_name;
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      // Check if an image was chosen
        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          return 0;
        }
        // Check file size
        if ($_FILES["upload-image"]["size"] > 5000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
          return null;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
          return null;
        }
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["upload-image"]["tmp_name"], $target_file)) {
          return $file_name;
        } else {
          echo "Sorry, there was an error uploading your file.";
          return null;
        }
    }

    public function store_image($url, $title, $status) {
      global $conn;
      $added_user = $_SESSION['id'];
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //add userimage to images tab;e
      try {
        $sql = "insert into images (title,add_date,user_id,status,url)
      VALUES ('$title' , now() ,$added_user,'$status','$url')";
        //use exec() because no results are returned
        $conn->exec($sql);
        return $this->get_image_id($url);
      } catch (PDOException $e) {
        print $sql . "<br>" . $e->getMessage();
        return $this->get_image_id('none.jpg');
      }
    }
  }
