<?php
  /*
  @package Sunset-theme
    This is The Template For Header
  */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title><?php bloginfo('name'); wp_title('|'); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if( is_singular() && pings_open(get_queried_object()) ): ?>
      <link rel="pingback" href="<?php bloginfo('pingback'); ?>">
    <?php endif; ?>
    <meta name0="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>

  </head>
  <body class="<?php body_class();?>">
    <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-container background-image" style="background-image:url(<?php header_image();?>)">
              <!-- <div class="upper-menu text-right">
                <i>icon</i>
              </div> -->
              <div class="header-content text-center table">
                <div class="table-cell">
                  <h1 class="site-title">
                    <span class="sunset-icon sunset-logo"></span>
                    <span class="d-none"><?php bloginfo('name'); ?></span>
                  </h2>
                  <h2 class="site-description"><?php bloginfo('description'); ?></p>
                </div>
              </div>
              <div class="nav-container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <?php
                      wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class' => 'navbar-nav',
                            'container' => false,
                            'walker' => new Sunset_Walker_Nav_Primary,
                          )
                      );
                   ?>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
