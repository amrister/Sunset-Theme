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
