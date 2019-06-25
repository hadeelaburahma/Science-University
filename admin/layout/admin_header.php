<nav class="navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse"
              data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="logoimg"><a class="navbar-brand" href="../index.php"><img
            id="logo" src="../images/logo.png"></a></div>
    </div>
    <div class=" border-bottom">
      <div class="full-left">
        <div class="clearfix"></div>
      </div>


      <!-- Brand and toggle get grouped for better mobile display -->

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="drop-men">
        <ul class=" nav_1">

          <li class="dropdown">
            <a href="#" class="dropdown-toggle dropdown-at"
               data-toggle="dropdown">
              <img class="img-circle user_image" src=<?php global $target_dir;
                print $target_dir . ($_SESSION['image']); ?>>

              <span
                class=" name-caret"><?php print ($_SESSION['username']); ?><i
                  class="caret"></i></span>
            </a>
            <ul class="dropdown-menu " role="menu">
              <li><a href="profile.php"><i class="fa fa-user"></i>Edit
                  Profile</a></li>
              <li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
      <div class="clearfix">
      </div>

      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">

            <li>
              <a href="index.php" class=" hvr-bounce-to-right"><i
                  class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span>
              </a>
            </li>
            <?php
              if ($role == 1) {
                print ('<li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="add_user.php" class=" hvr-bounce-to-right"> <i class="fa fa-user-plus nav_icon"></i>Add New User</a></li>

                            <li><a href="edit_users.php" class=" hvr-bounce-to-right"><i class="fa fa-edit nav_icon"></i>Edit Users</a></li>
					   </ul>
										</li>');
              }
            ?>
            <li>
              <a href="#" class=" hvr-bounce-to-right"><i
                  class="fa fa-newspaper-o nav_icon"></i> <span
                  class="nav-label">News</span><span
                  class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                <li><a href="add_news.php" class=" hvr-bounce-to-right"> <i
                      class="fa fa-plus nav_icon"></i>Add News</a></li>

                <li><a href="edit_news.php" class=" hvr-bounce-to-right"><i
                      class="fa fa-pencil nav_icon"></i>Edit News</a></li>
              </ul>
            </li>

            <li>
              <a href="#" class=" hvr-bounce-to-right"><i
                  class="fa fa-calendar-o nav_icon"></i> <span
                  class="nav-label">Events</span><span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                <li><a href="add_events.php" class=" hvr-bounce-to-right"><i
                      class="fa fa-plus nav_icon"></i>Add Events</a></li>

                <li><a href="edit_events.php" class=" hvr-bounce-to-right"><i
                      class="fa fa-pencil nav_icon"></i>Edit Events</a></li>
              </ul>
            </li>
            <li>
              <a href="add_slide.php" class=" hvr-bounce-to-right"><i
                  class="fa fa-picture-o nav_icon"></i>
                <span class="nav-label">Slider</span> </a>
              <ul class="nav nav-second-level">
                <li><a href="add_slide.php" class=" hvr-bounce-to-right"> <i
                      class="fa fa-plus nav_icon"></i>Add
                    Slide</a></li>

                <li><a href="edit_slides.php" class=" hvr-bounce-to-right"><i
                      class="fa fa-pencil nav_icon"></i>Edit
                    Slide</a></li>
              </ul>
            </li>
            <li>
              <a href="add_menus.php" class=" hvr-bounce-to-right"><i
                  class="fa fa-bars nav_icon"></i>
                <span class="nav-label">Menus</span> </a>
              <ul class="nav nav-second-level">
                <li><a href="add_menu.php" class=" hvr-bounce-to-right"> <i
                      class="fa fa-plus nav_icon"></i>Add
                    Menus</a></li>
                <li><a href="edit_menus.php" class=" hvr-bounce-to-right"> <i
                      class="fa fa-pencil nav_icon"></i>Edit
                    Menus</a></li>
              </ul>
            </li>
            <li>
              <a href="contact_messages.php" class=" hvr-bounce-to-right"><i
                  class="fa fa-envelope nav_icon"></i>
                <span class="nav-label">Contact Messages</span> </a>
            </li>
          </ul>
        </div>
      </div>
  </nav>