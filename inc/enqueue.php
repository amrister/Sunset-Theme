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


/*
  ===============================
    Website Enqueue Function
  ===============================
*/
function sunset_enqueue_files(){

  // CSS Files
  wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css',array(), '4.1.0', 'all' );
  wp_enqueue_style( 'sunset-master', get_template_directory_uri().'/css/master.css', array(), '1.0.0', 'all' );

  // JS Files
  wp_enqueue_script( 'jQuery', get_template_directory_uri().'/js/jquery-3.2.1.min.js', flase, '3.2.1' , true);
  wp_enqueue_script( 'bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array('jQuery'), '4.1.0' , true);
  wp_enqueue_script( 'popper', get_template_directory_uri().'/js/popper.min.js', array('bootstrap-js'), '1.0.0' , true);
  wp_enqueue_script( 'sunset-main', get_template_directory_uri().'/js/main.js', array(), '1.0.0' , true);

  // Fonts
  wp_enqueue_style('raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500&display=swap');
  
}
add_action('wp_enqueue_scripts','sunset_enqueue_files');
