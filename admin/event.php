<?php
  include 'article.php';

  class event extends article {

    private $event_id;

    private $start_date;

    private $end_date;

    private $location;

    private $article_id;

    private $image;

    //get event id by article id
    public function get_event_id($article_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_id = $conn->prepare('SELECT event_id FROM events WHERE article_id=:article_id');
      $return_id->bindParam('article_id', $article_id, PDO::PARAM_STR); //assuming it is a string
      $return_id->execute();
      $result = $return_id->fetchAll();
      $article_id = ($result[0]['event_id']);
      return $article_id;
    }

    public function get_eventarticle_id($event_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_id = $conn->prepare('SELECT article_id FROM events WHERE event_id=:event_id');
      $return_id->bindParam('event_id', $event_id, PDO::PARAM_STR); //assuming it is a string
      $return_id->execute();
      $result = $return_id->fetchAll();
      $article_id = ($result[0]['article_id']);
      return $article_id;
    }

    public function get_event_imageid($event_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_image = $conn->prepare('SELECT image FROM events WHERE event_id=:event_id');
      $return_image->bindParam('event_id', $event_id, PDO::PARAM_STR); //assuming it is a string
      $return_image->execute();
      $result = $return_image->fetchAll();
      $article_image = ($result[0]['image']);
      return $article_image;
    }

    public function get_event_image($event_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_image = $conn->prepare('SELECT events.image,images.url FROM events,images WHERE events.event_id=:event_id and events.image = images.image_id');
      $return_image->bindParam(':event_id', $event_id, PDO::PARAM_STR); //assuming it is a string
      $return_image->execute();
      $result = $return_image->fetchAll();
      foreach ($result as $key => $value) {
        $image[$value['image']] = $value['url'];
      }
      return $value['url'];
    }

    // SELECT DATE_FORMAT(start_date, '%Y-%m-%dT%H:%i') from events;
    public function get_event_date($event_id, $date_type) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_date = $conn->prepare("SELECT DATE_FORMAT($date_type, '%Y-%m-%dT%H:%i') as date from events 
       WHERE event_id=:event_id");
      $return_date->bindParam(':event_id', $event_id, PDO::PARAM_STR); //assuming it is a string
      $return_date->execute();
      $result = $return_date->fetchAll();
      $start_date = ($result[0]['date']);
      return $start_date;

    }

    public function store_event($image_id) {
      $article_id = $this->store_article(2, $image_id);
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $start_date = date('Y-m-d H:i;00', strtotime($_POST["startdate"]));
      $end_date = date('Y-m-d H:i;00', strtotime($_POST["enddate"]));
      $location = $_POST['location'];
      $sql = "insert into events (start_date,end_date,location,article_id,image)
            VALUES ('$start_date','$end_date','$location',$article_id,$image_id)";
      try {
        //use exec() because no results are returned
        $conn->exec($sql);
        return $this->get_event_id($article_id);
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    //select articles.article_id, articles.title,articles.status,events.event_id,events.start_date,events.end_date,events.location from articles,events where articles.article_id=events.article_id;
    public function get_all_events() {
      global $conn;
      $articles = [];
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_events = $conn->prepare("select articles.article_id, articles.title,articles.status,events.event_id,events.start_date,events.end_date,events.location
        from articles,events where articles.article_id=events.article_id;");
      try {
        $return_events->execute();
        $result = $return_events->setFetchMode(PDO::FETCH_ASSOC);
        $result = $return_events->fetchAll();
        return $result;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_event_info($event_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_event = $conn->prepare("select events.event_id,events.end_date,
        events.start_date,events.article_id,events.image, events.location,
        articles.title,articles.body,articles.status from events,articles 
        where event_id=$event_id and events.article_id=articles.article_id");
      try {
        $return_event->execute();
        $result = $return_event->setFetchMode(PDO::FETCH_ASSOC);
        $result = $return_event->fetchAll();
        return $result;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_latest_events() {
      global $conn;
      $articles = [];
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_events = $conn->prepare("select events.event_id,events.end_date,
        events.start_date,events.article_id,events.image, events.location,
        articles.title,articles.body,articles.status from events,articles 
        where events.article_id=articles.article_id 
        and articles.status=1 order by events.end_date desc limit 3");
      try {
        $return_events->execute();
        $result = $return_events->setFetchMode(PDO::FETCH_ASSOC);
        $result = $return_events->fetchAll();
        return $result;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_published_events() {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_events = $conn->prepare("select events.event_id,events.end_date,
        events.start_date,events.article_id,events.image, events.location,
        articles.title,articles.body,articles.status from events,articles 
        where events.article_id=articles.article_id 
        and articles.status=1 order by events.end_date desc");
      try {
        $return_events->execute();
        $result = $return_events->setFetchMode(PDO::FETCH_ASSOC);
        $result = $return_events->fetchAll();
        return $result;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function update_event($event_id, $image_id) {
      $article_id = $this->get_eventarticle_id($event_id);
      $this->update_article(2, $article_id);
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $start_date = date('Y-m-d H:i;00', strtotime($_POST["startdate"]));
      $end_date = date('Y-m-d H:i;00', strtotime($_POST["enddate"]));
      $location = $_POST['location'];
      if (empty($_FILES['upload-image']['name'])) {
        $sql = "update events set start_date='$start_date', end_date='$end_date',location='$location'
        where article_id='$article_id';";
      }
      else {
        $sql = "update events set start_date='$start_date', end_date='$end_date',image=$image_id, location='$location'
        where article_id='$article_id';";
      }
      try {
        //use exec() because no results are returned
        $conn->exec($sql);
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }
    }

  }
