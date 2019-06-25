<?php

  class article {

    private $article_id;

    private $article_title;

    private $article_body;

    private $article_creation_date;

    private $image_id;

    private $admin_id;

    private $article_status;

    private $last_modified;

    private $article_type;

    private $article_date;

    public function __construct() {
      db_connect();
    }

    public function __destruct() {
      db_close();
    }

    public function get_article_id($article_title) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_id = $conn->prepare('SELECT article_id FROM articles WHERE title=:title');
      $return_id->bindParam(':title', $article_title, PDO::PARAM_STR); //assuming it is a string
      $return_id->execute();
      $result = $return_id->fetchAll();
      $id = ($result[0]['article_id']);
      return $id;
    }

    public function get_article_title($article_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_title = $conn->prepare('SELECT title FROM articles WHERE article_id=:article_id');
      $return_title->bindParam('article_id', $article_id, PDO::PARAM_STR); //assuming it is a string
      $return_title->execute();
      $result = $return_title->fetchAll();
      $article_title = ($result[0]['title']);
      return $article_title;
    }

    public function get_article_body($article_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_body = $conn->prepare('SELECT body FROM articles WHERE article_id=:article_id');
      $return_body->bindParam('article_id', $article_id, PDO::PARAM_STR); //assuming it is a string
      $return_body->execute();
      $result = $return_body->fetchAll();
      $article_body = ($result[0]['body']);
      return $article_body;
    }

    public function get_article_status($article_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_status = $conn->prepare('SELECT status FROM articles WHERE article_id=:article_id');
      $return_status->bindParam('article_id', $article_id, PDO::PARAM_STR); //assuming it is a string
      $return_status->execute();
      $result = $return_status->fetchAll();
      $article_status = ($result[0]['status']);
      return $article_status;
    }

    //return article date in 2 formats
    public function get_article_date($article_id, $preview) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_date = $conn->prepare('SELECT article_date FROM articles WHERE article_id=:article_id');
      $return_date->bindParam('article_id', $article_id, PDO::PARAM_STR); //assuming it is a string
      $return_date->execute();
      $result = $return_date->fetchAll();
      $date1 = ($result[0]['article_date']);
      if ($preview) {
        $article_date = date('F d, Y', strtotime($date1));
        return $article_date;
      }
      else {
        return $date1;
      }
    }

    public function get_article_type($article_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_title = $conn->prepare('SELECT article_type FROM articles WHERE article_id=:article_id');
      $return_title->bindParam('article_id', $article_id, PDO::PARAM_STR); //assuming it is a string
      $return_title->execute();
      $result = $return_title->fetchAll();
      $article_title = ($result[0]['article_type']);
      return $article_title;
    }

    //store article and return its id
    public function store_article($article_type) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $article_title = $_POST['title'];
      $article_body = $_POST['body'];
      if ($article_type == 1) {
        $article_date = $_POST['date'];
      }
      else {
        $article_date = date('Y-m-d H:I;00', strtotime($_POST["startdate"]));
      }
      $admin = $_SESSION['id'];
      $sql = "insert into articles (title,body, creation_date,admin_id,
            status,last_modified, article_type,article_date)
            VALUES ('$article_title' ,'$article_body' ,now(), $admin ,
            3,now(),$article_type,'$article_date')";
      try {
        //use exec() because no results are returned
        $conn->exec($sql);
        return $this->get_article_id($article_title);
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_all_articles($article_type) {
      global $conn;
      $articles = [];
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_articles = $conn->prepare("select article_id,title,status,article_date from articles 
      where article_type='$article_type' order by article_date desc");
      $return_articles->execute();
      $result = $return_articles->setFetchMode(PDO::FETCH_ASSOC);
      $result = $return_articles->fetchAll();
      return $result;
    }

    public function get_article_info($article_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_article = $conn->prepare("select title,body,status,article_date,article_type from articles where article_id='$article_id'");
      $return_article->execute();
      $result = $return_article->setFetchMode(PDO::FETCH_ASSOC);
      $result = $return_article->fetchAll();
      return $result;
    }

    //update articles set title='$article_title', status=$status, body='$article_body',last_modified=now(),article_date='$date' where article_id=1;
    public function update_article($article_type, $id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $article_title = $_POST['title'];
      $article_body = $_POST["body"];
      $status = $_POST["status"];
      if ($article_type == 1) {
        $article_date = $_POST['date'];
      }
      else {
        $article_date = date('Y-m-d H:I;00', strtotime($_POST["startdate"]));
      }
      try {
        $sql = "update articles set title='$article_title', status=$status, body='$article_body',
                last_modified=now(),article_date='$article_date'
                where article_id='$id';";
        //use exec() because no results are returned
        $conn->exec($sql);
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }

    }

    public function get_all_statuses($type) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_status = $conn->prepare("SELECT DISTINCT status FROM articles where article_type='$type'");
      $return_status->execute();
      $result = $return_status->setFetchMode(PDO::FETCH_ASSOC);
      $result = $return_status->fetchAll();
      return $result;
    }

    //select article_id ,title, body,article_date from articles where article_type=1 and status=1 order by article_date DESC LIMIT 3;
    public function get_latest_articles($type) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $return_articles = $conn->prepare("select article_id ,title, body,article_date from articles
        where article_type='$type' and status=1 order by article_date DESC LIMIT 3");
      $return_articles->execute();
      $result = $return_articles->setFetchMode(PDO::FETCH_ASSOC);
      $result = $return_articles->fetchAll();
      return $result;
    }

    //get all published articles
    public function get_published_articles($type) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //get articles of type news
      if ($type == 1) {
        $return_articles = $conn->prepare("select article_id ,title, body,article_date from articles
        where article_type='$type' and status=1 order by article_date DESC");
      }
      $return_articles->execute();
      $result = $return_articles->setFetchMode(PDO::FETCH_ASSOC);
      $result = $return_articles->fetchAll();
      return $result;
    }
  }
