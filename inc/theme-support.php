<?php

/*
@package Sunset-theme
  =========================================
   Include Post Formats
  =========================================
*/
  function sunset_theme_support_options(){

    // Post Formats
    $userChoices = get_option('post_formats');
    if(!empty($userChoices)){
      $postFormats = array('aside','gallery','link','image','quote','status','video','audio','chat');
      $toActivate = array();
      foreach ($postFormats as $format) {
        ( $userChoices[$format] ) ? $toActivate [] = $format : '';
      }
      add_theme_support( 'post-formats', $toActivate);
    }

    // Custom Header
    $custHeader = get_option('custom_header');
    if($custHeader){
      add_theme_support( 'custom-header' );
    }

    // Custom Background
    $custBackground = get_option('custom_background');
    if($custBackground){
      add_theme_support( 'custom-background' );
    }

  }
  add_action( 'init', 'sunset_theme_support_options');


/*
  =========================================
   Include Post Formats
  =========================================
*/
  function sunset_sidebar(){
    register_sidebar(
        array(
            'name' => esc_html__('Sunset Sidebar','Sunset-theme'),
            'id' => 'sunset-sidebar',
            'description' => 'Dynamic Right Sidebar',
            'before_widget' => '<section id="%1$s" class="sunset-widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
  }
  add_action('widgets_init','sunset_sidebar');
/*
  =========================================
   Activate Menus
  =========================================
*/
function sunset_register_header_menu(){
  register_nav_menu('primary', 'Header nav menu');
}
add_action( 'after_setup_theme','sunset_register_header_menu');

/*
  =========================================
   Activate Post Freatures
  =========================================
*/
add_theme_support('post-thumbnails');

/*
  =========================================
   Activate HTML5 for some sections
  =========================================
*/
add_theme_support( 'html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption') );
