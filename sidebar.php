<?php
/*
@package Sunset-theme
  This template is for Sidebar section
*/

  if( ! is_active_sidebar('sunset-sidebar')){
    return;
  }
?>

<aside id="secondary" class="widgets-area" role="complementary">
  <?php
      dynamic_sidebar('sunset-sidebar');
   ?>
</aside>
