<?php

/*
@package Sunset-theme
    ===============================
      ADMIN PAGE
    ===============================
*/
function sunset_custom_admin_page(){

  // Generate Sunset Admin Page
  add_menu_page( 'Sunset Theme Options', 'Sunset', 'manage_options', 'amr_sunset', 'sunset_create_page',get_template_directory_uri().'/images/sunset-icon.png', 110); // You Can Use WordPress Dashicon ex: dashicons-pressthis

  // Generate Sunset Admin SubPages
  add_submenu_page( 'amr_sunset', 'Sunset Sidebar Options', 'Sidebar', 'manage_options', 'amr_sunset','sunset_create_page'); // The main subpage
  add_submenu_page( 'amr_sunset', 'Sunset Theme Support', 'Theme Options', 'manage_options', 'amr_sunset_theme_support','sunset_them_support_subpage');
  add_submenu_page( 'amr_sunset', 'Sunset Contact Form', 'Contact Form', 'manage_options', 'amr_sunset_contact_form', 'sunset_contact_form_subpage');
  add_submenu_page( 'amr_sunset', 'Sunset Custom CSS', 'Custom CSS', 'manage_options', 'amr_sunset_css','sunset_css_subpage');

}
add_action('admin_menu','sunset_custom_admin_page');


// Active Custom Setting
add_action( 'admin_init', 'sunset_custom_setting');
function sunset_custom_setting(){

  // Sidebar Settings
  register_setting( 'sunset-settings-group', 'profile_picture');
  register_setting( 'sunset-settings-group', 'first_name','sunset_sanitization_normal');
  register_setting( 'sunset-settings-group', 'second_name','sunset_sanitization_name');
  register_setting( 'sunset-settings-group', 'description','sunset_sanitization_name');
  register_setting( 'sunset-settings-group', 'fb_handler','sunset_sanitization_normal');
  register_setting( 'sunset-settings-group', 'twitter_handler','sunset_sanitization_twitter');
  register_setting( 'sunset-settings-group', 'github_handler','sunset_sanitization_normal');

  add_settings_section( 'sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'amr_sunset' );

  add_settings_field( 'sunset-sidebar-picture', 'Profile Picture', 'sunset_sidebar_picutre', 'amr_sunset', 'sunset-sidebar-options');
  add_settings_field( 'sunset-sidebar-name', 'Full Name', 'sunset_sidebar_name', 'amr_sunset', 'sunset-sidebar-options');
  add_settings_field( 'sunset-sidebar-description', 'User Description', 'sunset_sidebar_description', 'amr_sunset', 'sunset-sidebar-options');
  add_settings_field( 'sunset-sidebar-facebook', 'Facebook Handler', 'sunset_sidebar_fb', 'amr_sunset', 'sunset-sidebar-options');
  add_settings_field( 'sunset-sidebar-twitter', 'Twitter Handler', 'sunset_sidebar_twitter', 'amr_sunset', 'sunset-sidebar-options');
  add_settings_field( 'sunset-sidebar-github', 'GitHub Handler', 'sunset_sidebar_github', 'amr_sunset', 'sunset-sidebar-options');

  // Theme Support Settings
  register_setting( 'sunset-support-group', 'post_formats');
  register_setting( 'sunset-support-group', 'custom_header');
  register_setting( 'sunset-support-group', 'custom_background');

  add_settings_section( 'sunset-support-options', 'Theme Options', 'sunset_support_options', 'amr_sunset_theme_support');

  add_settings_field( 'post-formats', 'Post Formats', 'sunset_post_formats', 'amr_sunset_theme_support','sunset-support-options');
  add_settings_field( 'custom-header', 'Custom Header', 'sunset_custom_header', 'amr_sunset_theme_support','sunset-support-options');
  add_settings_field( 'custom-background', 'Custom Background', 'sunset_custom_background', 'amr_sunset_theme_support','sunset-support-options');

  // Contact Form Settings
  register_setting( 'sunset-contact-group', 'activate_contact');

  add_settings_section( 'sunset-contact-settings', 'Contact Form', 'sunset_contact_settings', 'amr_sunset_contact_form');

  add_settings_field( 'sunset-contact-activate', 'Activate Contact Form ', 'sunset_contact_activate', 'amr_sunset_contact_form', 'sunset-contact-settings');
}

// Sidebar Functions
function sunset_sidebar_options(){
  echo "Customize Sidebar Options";
}
function sunset_sidebar_picutre(){
  $picture = esc_attr( get_option( 'profile_picture') );
  if(!empty($picture)){
    echo "<input type='button' class='button' value='Replace Profile Picture' id='upload-pic'>";
    echo " <input type='hidden' name='profile_picture' value='".$picture."' id='profile-picture'>";
    echo "<input type='button' class='button' value='Remove' id='remove-pic'>";
  }else{
    echo "<input type='button' class='button' value='Upload Profile Picture' id='upload-pic'>";
    echo " <input type='hidden' name='profile_picture' value='' id='profile-picture'>";
  }

}
function sunset_sidebar_name(){
  $firstValue = esc_attr( get_option( 'first_name') ); //Esc is to prevent un needed attr if exists;
  $secondValue = esc_attr( get_option( 'second_name') );
  echo "<input type='text' name='first_name' value='".$firstValue."' placeholder='First Name'>";
  echo " <input type='text' name='second_name' value='".$secondValue."' placeholder='Second Name'>";
}
function sunset_sidebar_description(){
  $description = esc_attr( get_option('description') );
  echo "<input type='text' name='description' value='".$description."' placeholder='User Description'><p class='description'>Write something smart</p>";
}
function sunset_sidebar_fb(){
  $facebook = esc_attr( get_option( 'fb_handler') );
  echo "<input type='text' name='fb_handler' value='".$facebook."' placeholder='Facebook Handler'>" ;
}
function sunset_sidebar_twitter(){
  $twitter = esc_attr( get_option( 'twitter_handler') );
  echo "<input type='text' name='twitter_handler' value='".$twitter."' placeholder='Twitter Handler'> <p class='description'>Pleae insert tag without @ symbol</p>" ;
}
function sunset_sidebar_github(){
  $github = esc_attr( get_option( 'github_handler') );
  echo "<input type='text' name='github_handler' value='".$github."' placeholder='GitHub Handler'>" ;
}

// Theme Options Functions
function sunset_support_options(){
	echo 'Activate and Deactivate specific Theme Support Options';
}
function sunset_post_formats(){
  $options = get_option('post_formats');
  $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
  $output = '';
  foreach ( $formats as $element ) {
    $checked = ( !empty( $options[$element] ) ) ? 'checked' : '';
    $output .= '<label><input type="checkbox"  id="'.$element.'" name="post_formats['.$element.']" value="1"  '.$checked.' >'.$element.'</label><br>';
  }
  echo $output;
}
function sunset_custom_header(){
  $custHeader = get_option('custom_header');
  $checked = (!empty($custHeader)) ? 'checked' : '';
  echo '<label><input type="checkbox" name="custom_header" id="custom_header" value="1" '.$checked.'>Activate the Custom Header</label><br>';
}
function sunset_custom_background(){
  $custBackground = get_option('custom_background');
  $checked = (!empty($custBackground)) ? 'checked' : '';
  echo '<label><input type="checkbox" name="custom_background" id="custom_background" value="1" '.$checked.'>Activate the Custom Background</label><br>';
}

// Contact Form Functions
function sunset_contact_settings(){
  echo 'Activate and Deactivate the Built-in Contact Form';
}
function sunset_contact_activate(){
  $cotnactActivate = get_option('activate_contact');
  $checked = ( !empty($cotnactActivate) ) ? 'checked' : '';
  echo "<label><input type='checkbox' name='activate_contact' id='activate_contact' value='1' ".$checked."></label><br>";
}

// Sanitization Settings
function sunset_sanitization_normal($input){
  $output = sanitize_text_field( $input); // To Remove any HTML Or Bad Inputs
  return $output;
}
function sunset_sanitization_twitter($input){
  $output = sanitize_text_field( $input); // To Remove any HTML Or Bad Inputs
  $output = str_replace( '@', '', $output);
  return $output;
}


// Creation of Admin Page
function sunset_create_page(){
  require_once (get_template_directory().'/inc/templates/sunset-admin.php');
}

// Creation of Admin SubPages
function sunset_them_support_subpage(){
  require_once (get_template_directory().'/inc/templates/sunset-theme-support.php');
}
function sunset_contact_form_subpage(){
  require_once ( get_template_directory().'/inc/templates/sunset-form-contact.php');
}
function sunset_css_subpage(){
  echo "<h1>Test, This Custom CSS Page is For Admins</h1>";
}
