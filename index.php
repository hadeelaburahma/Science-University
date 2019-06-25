<?php
  include 'functions.php';
  include 'settings.php';
  include 'admin/user.php';
  include 'admin/image.php';
  include 'admin/event.php';
  include 'admin/slider.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    include_once 'layout/head.html';
  ?>
  <title>SU | Homepage</title>
<script type="text/javascript" src="style/js/slick/slick.min.js"></script>
<link rel="stylesheet" type="text/css" href="style/js/slick/slick.css"/>

<link rel="stylesheet" type="text/css" href="style/js/slick/slick-theme.css"/>
</head>

<body>
<?php
  include_once 'layout/header.php';
?>
<!--end of header-->

<div class="bodycontent">

  <div class="single-item">
    <?php
      $slider = new slider();
      $slides = $slider->get_all_displayed_slides();
      foreach ($slides as $key => $value) {
         print('<div class="mySlides fade">');
        print('<div class="mainImg">
              <img src="' . $slider_images . $value['url'] . '">
              <div class="main-text">
                <p>' . $value['content'] . '</p>
              </div>
            </div>
          </div>');
      }
    ?>
  </div>
  <!--end of slide show-->


  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="programs">
              <div class="row">
                <div class="col-xs-6">
                  <div class="bimages">
                    <img src="images/b1.png">
                    <div class="imagestext">
                      <p>undergraduate courses</p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="bimages">
                    <img src="images/b2.png">

                    <div class="imagestext">
                      <p>graduate courses</p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="bimages">
                    <img src="images/b3.png">
                    <div class="imagestext">
                      <p>international students</p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="bimages">
                    <img src="images/b4.png">
                    <div class="imagestext">
                      <p>scholarships</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="h3-headers news">
              <a href="news.php"><h3>news</h3></a>

              <?php
                $article = new article();
                $news = $article->get_latest_articles(1);

                foreach ($news as $key => $value) {
                  print ('
                    <div class="articles">
                    <a href="/news.php?id=' . $value['article_id'] . '">
                    <span class="dates">
                     ' . date('F d, Y', strtotime($value['article_date'])) . '
                    </span>
                    <h4>' . $value['title'] . '</h4>
                    <div class="brief">
                      <p> ' . substr(strip_tags($value['body']), 0, 120) . '... </p>
                    </div>
                    <div class="more">
                      <a href="/news.php?id=' . $value['article_id'] . '">read more</a>
                    </div>
                  </a>
                  </a>
                  </div>
                   ');
                }


              ?>

            </div>

          </div>
        </div>
        <!--end of row-->
      </div>
    </div>
  </div>
  <!--end of news and programs-->
  <div class="info">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="infoimg">
            <img src="images/profession.png">
            <div class="numbers">
              <h1>90+</h1>
            </div>
            <div class="short-info">
              <p>Profession-ready degree programs</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="infoimg">
            <img src="images/dollar.png">
            <div class="numbers">
              <h1>#1</h1>
            </div>
            <div class="short-info">
              <p>Our MBA for salary-to-debt ratio</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="infoimg">
            <img src="images/cap.png">
            <div class="numbers">
              <h1>100,000</h1>
            </div>
            <div class="short-info">
              <p>Sciences University alumni worldwide</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end of info-->
  <div class="h3-headers events">
    <div class="container">
      <div class="event-title">
        <h3>events</h3>
      </div>
      <?php
        $event = new event();
        $latest_events = $event->get_latest_events();
        foreach ($latest_events as $value) {
          $event_id = $event->get_event_id($value['article_id']);
          print('
          <div class="row">
          <div class=" col col-md-4">
          <a href="events.php?id=' . $event_id . '"><div class="event-body">
              <div class="events-images">
                <img src="' . $articles_images . $event->get_event_image($event_id) . '">
                <div class="calendar">
                  <img src="images/calendar.png">
                </div>
                <div class="eday">
                  <h2>' . date('d', strtotime($value['end_date'])) . '</h2>
                </div>
                <div class="emonth">
                  <h3>' . date('M', strtotime($value['end_date'])) . '</h3>
                </div>

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
<!--end of events-->
<div class="mainImg admission">
  <div class="container-fluid">
    <div class="row">
      <img src="images/admission.png">
      <div class="admission-text">
        <p>ADMISSIONS ARE NOW OPEN
          FOR <?php echo (date("Y") - 1) . "/" . date("Y"); ?> INTAKE</p>
        <div class="apply-button">
          <button class="apply-btn">APPLY NOW!</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end of admission-->
<div class="container">
  <div class="row">
    <div class="get-in-touch">
      <div class="h3-headers get-title">
        <h3>get in touch</h3>
      </div>
      <div class="get-touch">
        <form action="submission_thanks.php" method="post" id="intouch-form">

          <div class="form-group full-name input2row">
            <label class="label" for="fname">Full Name: </label>
            <input type="text" class="form-control full-name" id="fname"
                   placeholder="Full Name" name="fname" minlength="2" required>
          </div>
          <div class="form-group phone-num input2row">
            <label class="label" for="phone">Phone:</label>
            <input type="tel" class="form-control phone-number" id="phone"
                   placeholder="Phone Number" name="phone" minlength="2"
                   required phoneUS>
          </div>
          <div class="form-group">
            <label class="label" for="email">Email address:</label>
            <input type="email" class="form-control" id="email"
                   placeholder="Email" name="email" required>
          </div>
          <div class="form-group">
            <label class="label" for="message">Message:</label>
            <textarea class="form-control" rows="5" id="message"
                      placeholder="Message" name="message" minlength="250"
                      required onkeyup="countChar(this)"></textarea>
          </div>
          <div id="charNum">0 Charecters</div>
          <button type="submit" class="btn btn-default submit-btn">Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--end of get in touch form-->
<?php
  include_once 'layout/footer.php';
?>
<!--end of bottom footer-->
</div>
<!--end of body contents-->
</body>

</html>