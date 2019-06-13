<?php
  $firstName = esc_attr( get_option('first_name'));
  $secondName = esc_attr( get_option('second_name'));
  $fullName = $firstName.' '.$secondName;
  $description = esc_attr( get_option('description'));
  $profilePicutre = esc_attr( get_option('profile_picture') );
?>
<div class="page-cont">
  <div class="actual-data">
    <h1>Sunset Sidebar Options</h1>
    <p style="margin-bottom: 50px">Here is the place where you can fully cutomize your sidebar options</p>
    <form class="sidebar-options" action="options.php" method="post">
      <?php
      settings_errors();
      settings_fields('sunset-settings-group');
      do_settings_sections( 'amr_sunset');
      submit_button('Save Changes', 'primary', 'btnSubmit'); // To Remove Interference with JS
      ?>
    </form>
  </div>
  <div class="sidebar-preview">
    <div class="image" id='profile-picture-preview' style = "background-image: url(<?php print $profilePicutre; ?>) ">
    </div>
    <h2><?php print $fullName; ?></h2>
    <p><?php print $description ?></p>
    <div class="">

    </div>
  </div>
</div>
