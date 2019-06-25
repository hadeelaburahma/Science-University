<?php

  class slider {

    private $id;

    private $image_id;

    private $content;

    private $display;

    public function __construct() {
      db_connect();
    }

    public function __destruct() {
      db_close();
    }


    public function add_slide() {
      global $slider_images, $conn;
      $image = new image();
      $url = $image->upload_image($slider_images);
      if (isset($url)) {
        $image_id = $image->store_image($url, 'slider', 2);
      }
      else {
        return 0;
      }
      $content = $_POST['content'];
      $display = $_POST['display'];
      try {
        $sql = "insert into slider (content,image,display)
        VALUES ('$content' , $image_id,$display)";
        //use exec() because no results are returned
        $conn->exec($sql);
        $_SESSION['message'] = "Slide Succefully Added!";
      } catch (PDOException $e) {
        print $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    //
    public function get_all_slides() {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_slides = $conn->prepare("select slider.id,slider.content,slider.display,images.url
      from slider,images where slider.image=images.image_id");
      try {
        $return_slides->execute();
        $result = $return_slides->setFetchMode(PDO::FETCH_ASSOC);
        $result = $return_slides->fetchAll();
        return $result;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_all_displayed_slides() {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_slides = $conn->prepare("select slider.id,slider.content,slider.display,images.url
      from slider,images where slider.display=1 and slider.image=images.image_id");
      try {
        $return_slides->execute();
        $result = $return_slides->setFetchMode(PDO::FETCH_ASSOC);
        $result = $return_slides->fetchAll();
        return $result;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_slide_image_id($slide_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_image = $conn->prepare('SELECT image FROM slider WHERE id=:id');
      $return_image->bindParam(':id', $slide_id, PDO::PARAM_STR); //assuming it is a string
      $return_image->execute();
      $result = $return_image->fetchAll();
      $image = ($result[0]['image']);
      return $image;
    }

    public function get_slide_image($slide_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_image = $conn->prepare("SELECT slider.image,images.url FROM slider,images WHERE slider.id='$slide_id' and slider.image=images.image_id");
      $return_image->bindParam(':user_id', $id, PDO::PARAM_STR); //assuming it is a string
      $return_image->execute();
      $result = $return_image->fetchAll();
      foreach ($result as $key => $value) {
        $image[$value['image']] = $value['url'];
      }
      return $value['url'];
    }

    public function get_slide_content($slide_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_content = $conn->prepare('SELECT content FROM slider WHERE id=:id');
      $return_content->bindParam(':id', $slide_id, PDO::PARAM_STR); //assuming it is a string
      $return_content->execute();
      $result = $return_content->fetchAll();
      $content = ($result[0]['content']);
      return $content;
    }

    public function get_slide_display($slide_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_display = $conn->prepare('SELECT display FROM slider WHERE id=:id');
      $return_display->bindParam(':id', $slide_id, PDO::PARAM_STR); //assuming it is a string
      $return_display->execute();
      $result = $return_display->fetchAll();
      $display = ($result[0]['display']);
      return $display;
    }

    public function get_slide_info($slide_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $return_slide = $conn->prepare('SELECT slider.id,slider.content,slider.image,slider.display,images.url 
        FROM slider,images WHERE id=:id and slider.image=images.image_id');
        $return_slide->bindParam(':id', $slide_id, PDO::PARAM_STR); //assuming it is a string
        $return_slide->execute();
        $result = $return_slide->fetchAll();
        return $result;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function update_slide($slide_id) {
      global $slider_images, $conn;
      if (!empty($_FILES['upload-image']['name'])) {
        $image = new image();
        $url = $image->upload_image($slider_images);
        if (isset($url)) {
          $image_id = $image->store_image($url, 'slider', 2);
        }
      }
      else {
          $image_id = $this->get_slide_image_id($slide_id);
        }
        $content = $_POST['content'];
        $display = $_POST['display'];
        try {
          $sql = "update slider set content='$content',image=$image_id,display='$display'
      where id=$slide_id";
          //use exec() because no results are returned
          $conn->exec($sql);
          $_SESSION['message'] = "Slide Succefully Updated!";
        } catch (PDOException $e) {
          print $sql . "<br>" . $e->getMessage();
          return NULL;
        }
    }
  }