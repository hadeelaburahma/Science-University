<?php
  include 'admin/user.php';
  include 'admin/image.php';
  include 'admin/article.php';
  include 'functions.php';
  if (empty($_GET['id'])) {
    header('Location: news_list.php');
  }
  else {
    $article_id = $_GET['id'];
    $article = new article();
    if ($article->get_article_type($article_id) == 1 && $article->get_article_status($article_id) == 'published') {
      $article_info = $article->get_article_info($article_id);
      $title = $article_info[0]['title'];
      $date = $article_info[0]['article_date'];
      $body = $article_info[0]['body'];
    }
    else {
      header('Location: news_list.php');
    }
  }
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
  <div class="container">
    <div class="row">
      <div class="h3-headers news">
        <?php
          print('<h3 class="news_title">' . $title . '</h3>
                <div class="articles">
                    <span class="dates">' . date('F d, Y', strtotime($date)) . '
                    </span>
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