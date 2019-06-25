<?php
  $explore = $menu->get_menu_items(4);
  $quick = $menu->get_menu_items(6);
  $using_site = $menu->get_menu_items(7);
  $find_us = $menu->get_menu_items(8);
?>
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col col-sm-3">
        <div class="explore">
          <ul class="explore-list">
            <div class="ul-header">
              <h4>Explore<span class="fa fa-caret-down explore-btn"></span><span
                  class="fa fa-caret-up explore-ubtn"></span></h4>
            </div>
            <?php
              foreach ($explore as $key => $value) {
                if($value['link'] == null)
                print ('<li>' . $value['title'] . '</li>');
                else
                print ('<a href="'.$value['link'].'"><li>' . $value['title'] . '</li></a>');
              }
            ?>
          </ul>
        </div>
      </div>
      <!--end of explore colomn-->
      <div class="col col-sm-3">
        <div class="quick-links">
          <ul class="quick-link-list">
            <div class="ul-header">
              <h4>quick links<span
                  class="fa fa-caret-down quick-link-btn"></span><span
                  class="fa fa-caret-up quick-link-ubtn"></span></h4>
            </div>
            <?php
              foreach ($quick as $key => $value) {
                if($value['link'] == null)
                print ('<li>' . $value['title'] . '</li>');
                else
                print ('<a href="'.$value['link'].'"><li>' . $value['title'] . '</li></a>');  
              }
            ?>
          </ul>
        </div>
        <!--end of quick links-->
        <div class="using-our-site">
          <ul class="site-list">
            <div class="ul-header">
              <h4>using our site<span class="fa fa-caret-down using-btn"></span><span
                  class="fa fa-caret-up using-ubtn"></span></h4>
            </div>
            <?php
              foreach ($using_site as $key => $value) {
                if($value['link'] == null)
                print ('<li>' . $value['title'] . '</li>');
                else
                print ('<a href="'.$value['link'].'"><li>' . $value['title'] . '</li></a>');
              }
            ?>
          </ul>
        </div>
        <!--end of using our site-->
      </div>
      <!--end of second col-->
      <div class="col col-sm-3">
        <div class="find-us">
          <ul class="find-us-list">
            <div class="ul-header">
              <h4>How to find us<span
                  class="fa fa-caret-down find-us-btn"></span><span
                  class="fa fa-caret-up find-us-ubtn"></span></h4>
            </div>
            <?php
              foreach ($find_us as $key => $value) {
                if($value['link']==null){
                  print ('<li class="' . $value['class'] . '">' . $value['title'] . '</li>');  
                }
                else
                print ('<a href="' . $value['link'] . '"><li class="' . $value['class'] . '">' . $value['title'] . '</a></li>');
              }
            ?>
          </ul>
        </div>
        <!--end of find us-->
      </div>
      <!--end of third col-->
      <div class="col col-sm-3">
        <div class="logo-social">
          <div class="footer-logo">
            <div class="logoimg">
              <img id="logo" src="images/footerlogo.png" alt="SU logo"/>
            </div>
          </div>
          <div class="social-media">
            <div class="ul-header">
              <h4>follow us</h4>
            </div>
            <div class="micons">
              <?php
                foreach ($social_media as $key => $value) {
                  print('
                <a ' . $value['title'] . ' href="' . $value['link'] . '" class="fa fa-' . $value['class'] . '"></a>
                ');
                }
              ?>
            </div>
          </div>
        </div>
        <!--end of logo social-->
      </div>
      <!--end of forth col-->
    </div>
  </div>
</div>
<!--end of footer-->


<div class="bottom-footer">
  <div class="container">
    <div class="row">
      <div class="bfooter">
        <p>© <?php echo date("Y"); ?> Sciences University. All Rights
          Reserved.</p>
      </div>
    </div>
  </div>
</div>
<!--end of bottom footer-->