<?php
//  $firstName = esc_attr( get_option('first_name'));
?>
<div class="page-cont">
  <div class="actual-data">
    <h1>Sunset Theme Support</h1>
    <p style="margin-bottom: 50px">Here is the place where you can fully cutomize your theme options</p>
    <form class="Sidebar-options" action="options.php" method="post">
      <?php
        settings_errors();
        settings_fields('sunset-support-group' );
        do_settings_sections('amr_sunset_theme_support');
        submit_button();
      ?>
    </form>
  </div>
</div>
