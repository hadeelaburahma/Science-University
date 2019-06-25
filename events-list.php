<?php
  include 'functions.php';
  include 'settings.php';
  include 'admin/user.php';
  include 'admin/image.php';
  include 'admin/event.php';
  $event = new event();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    include_once 'layout/head.html';
  ?>
  <title>SU | Events</title>
</head>

<body>
<?php
  include_once 'layout/header.php';
?>
<!--end of header-->
<div class="body-content">
  <div class="inner-image">
    <div class="container-fluid">
      <div class="row">
        <img src="images/innerimg.jpg">
        <div class="inner-text">
          <p>Events</p>
        </div>
      </div>
    </div>
  </div>
  <!--end of main image-->
  <div class="container">
    <div class="row">
      <div class="h3-headers news">
        <h3>Events</h3>

        <?php
          $events = $event->get_published_events();
          foreach ($events as $value) {
            $event_id = $event->get_event_id($value['article_id']);
            print('<div class="container">
                  <div class="row">
                  <a href="events.php?id=' . $event_id . '"><div class="event-body">
              <div class="events-images">
                <img src="' . $articles_images . $event->get_event_image($event_id) . '">
              </div>
              <div class="events-time">
                <span class="time">' . date('g:i A', strtotime($value['start_date'])) . '-' . date('g:i A', strtotime($value['end_date'])) . '</span><span>|</span>
                <span class="location">' . $value['location'] . ' Campus</span>
              </div>
              <h4>' . $value['title'] . '</h4>
              <div class="brief">
                <p>' . substr(strip_tags($value['body']), 0, 120) . '....</p>
              </div>
              <div class="more">
                <a href="events.php?id=' . $event_id . '">learn more</a>
              </div>
            </div>
          </div></a>');
          }
        ?>
      </div>
    </div>
  </div>
</div>
</div>
</div>    <!--end of body contents-->

<!--end of body contents-->
<?php
  include_once 'layout/footer.php';
?>
</body>

</html>