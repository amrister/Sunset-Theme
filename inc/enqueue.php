<?php

/*
@package Sunset-theme
    ===============================
      ADMIN Enqueue Functions
    ===============================
*/
function sunset_admin_enqueues($page){

  // echo $page;
  if($page!='toplevel_page_amr_sunset'){ // To Include Script in only General Page in Sunset Admin
    return;
  }

  // CSS Files
  wp_register_style( 'sunset_admin', get_template_directory_uri().'/css/sunset.admin.css',array(), '1.0.0', 'all');
  wp_enqueue_style('sunset_admin');

  // JS Files
  wp_register_script( 'sunset_admin_js', get_template_directory_uri().'/js/sunset.admin.js', array(), '1.0.0', true );
  wp_enqueue_script( 'sunset_admin_js');

  // To Active Required Files of WP for Media Uploader
  wp_enqueue_media();
}
add_action('admin_enqueue_scripts','sunset_admin_enqueues'); // Will make it included only on dashboard ( not in Front-End)
