<?php

/*
@package Sunset-theme
    ===============================
      Remove Generator ( Version )
    ===============================
*/
function sunset_remove_meta_version(){
    return '';
}
add_filter( 'the_generator', 'sunset_remove_meta_version');

/* remove ver variable from scripts and style srcs */
function sunset_remove_version_from_src($src){
  global $wp_version;
  parse_str(parse_url($src,PHP_URL_QUERY),$query);
  if(!empty($query['ver']) && $query['ver'] == $wp_version ){
    $src = remove_query_arg('ver',$src);
  }
  return $src;
}
add_filter( 'script_loader_src','sunset_remove_version_from_src');
add_filter( 'style_loader_src','sunset_remove_version_from_src');
/*
    ===============================
      Remove Generator
    ===============================
*/
