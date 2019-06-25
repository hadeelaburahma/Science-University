<?php
  include 'functions.php';
  include 'settings.php';
  include 'admin/user.php';
  include 'admin/image.php';
  include 'admin/event.php';
  if (empty($_GET['id'])) {
    header('Location: events-list.php');
  }
  else {
    $event_id = $_GET['id'];
    $event = new event();
    $article_id = $event->get_eventarticle_id($event_id);
    if ($event->get_article_status($article_id) == 'published') {
      $event_info = $event->get_event_info($event_id);
      $title = $event_info[0]['title'];
      $start_date = $event_info[0]['start_date'];
      $end_date = $event_info[0]['end_date'];
      $body = $event_info[0]['body'];
      $location = $event_info[0]['location'] . ' Campus';
    }
    else {
      header('Location: events-list.php');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    include_once 'layout/head.html';
  ?>
  <title>SU | Event</title>
</head>

<body>
<?php
  include_once 'layout/header.php';
?>
<!--end of header-->
<div class="body-content">
  <div class="container">
    <div class="row">
      <div class="h3-headers events">
        <?php
          print('<h3 class="news_title">' . $title . '</h3>
                <div class="articles">
                    <span class="dates">' . date('F d, Y', strtotime($start_date)) . ' - ' . date('F d, Y', strtotime($end_date)) . '</span>
                    <div class="location">' . $location . '</div>
                    <div class="eventsimages">
                <img src="' . $articles_images . $event->get_event_image($event_id) . '"></div>
                    <div class="brief">
                      <p> ' . $body . '</p>
                    </div>
                  </div>');
        ?>

      </div>

    </div>
    <!--end of body contents-->


    <!--end of bottom footer-->
  </div>
  <!--end of body contents-->
  <?php
    include_once 'layout/footer.php';
  ?>
</body>

</html>