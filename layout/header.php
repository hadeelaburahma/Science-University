<?php
  include "admin/menu.php";
  $menu = new menu();
  $main_menu = $menu->get_menu_items(3);
  $social_media = $menu->get_menu_items(5);
?>
<div class="header">
  <div class="top-header">
    <div class="container">
      <div class="row">
        <div class="logoimg">
          <a href="index.php">
            <img id="logo" src="images/logo.png" alt="SU logo"/></a>
        </div>
        <div class="social-media">
          <div class="sicons">
            <?php
              foreach ($social_media as $key => $value) {
                print('
                <a ' . $value['title'] . ' href="' . $value['link'] . '" class="fa fa-' . $value['class'] . '"></a>
                ');
              }
            ?>
          </div>
          <div class="search-box">
            <form>
              <input type="text" placeholder="Search...">
              <div class="search"></div>
            </form>
          </div>
        </div>
        <!--end of social media class-->
      </div>
    </div>
  </div>
  <!--end of top header-->

  <nav class="navbar navbar-default mynav">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle cbut" data-toggle="collapse"
                data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="micons">
          <?php
            foreach ($social_media as $key => $value) {
              print('
                <a ' . $value['title'] . ' href="' . $value['link'] . '" class="fa fa-' . $value['class'] . '"></a>
                ');
            }
          ?>
          <div class="search">
                <span>
                  <a href="#" class="fa fa-search"></a>
                </span>
          </div>
        </div>
        <div id="mobile-search">
          <input type="text" placeholder="Search.." id="sbut">
        </div>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav mynavbar">
          <?php
            foreach ($main_menu as $key => $value) {
              print('
              <li><a  href="' . $value['link'] . '">' . $value['title'] . '</a></li>
              ');
            }
          ?>
      </div>
      </ul>
    </div>
</div>
</nav>
</div>