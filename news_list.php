<?php
  include 'functions.php';
  include 'settings.php';
  include 'admin/user.php';
  include 'admin/image.php';
  include 'admin/article.php';
  $article = new article();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    include_once 'layout/head.html';
  ?>
  <title>SU | News</title>
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
          <p>News</p>
        </div>
      </div>
    </div>
  </div>
  <!--end of main image-->
  <div class="container">
    <div class="row">
      <div class="h3-headers news">
        <h3>news</h3>

        <?php
          $news = $article->get_published_articles(1);
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
                  </div>');
          }
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