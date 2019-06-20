<?php

/*
	@package Sunset-theme
  This is Template For Ajax Functions

  ==============================
  Load More Posts in Home Page
  ==============================
*/
  add_action('wp_ajax_nopriv_sunset_load_more','sunset_load_more'); // When User Call Function by ajax evenif not logged
  add_action('wp_ajax_sunset_load_more','sunset_load_more'); // When User Call Function by ajax and he logged
  function sunset_load_more(){

    $paged = $_POST['page'] + 1;
    $prev = $_POST['prev'];
    $archive   = $_POST['archive'];
    $page_trail='/wordpress/';

    if($prev && $_POST['page'] != 1){
      $paged = $_POST['page'] - 1;
    }

    $args =array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'paged' => $paged,
    );

    if( $archive != '0' ){ // As it differ From string to int
      $archValues = explode('/',$archive);
      $index = sunset_get_archType_index($archValues);
      if( $index != -1 ){
        $type =  ( $archValues[$index] == 'category' ) ? 'category_name' : $archValues[$index];
        $value = $archValues[$index+1];
        $args[$type] = $value;
      }
      $page_trail = '/wordpress/' . $archValues[$index]. '/' . $value .'/' ;
    }

    $query = new WP_Query($args);
    if($query->have_posts()){
      echo '<div class="page-limit" data-limit="'.$page_trail.'page/'.$paged.'">';
      while($query->have_posts()){
        $query->the_post();
        get_template_part('template-parts/mypostformat',get_post_format());
      }
      echo '</div>';
    }else{
      echo 0;
    }
    wp_reset_postdata();
    die(); // To Close Connection
  }


/*
  ==============================
    Get The Right Page Number
  ==============================
*/
  function sunset_page_check($num = 0){
    $output = '';
    if(is_paged()){ // Not Page 0
      $output .= 'page/'.get_query_var('paged');
    }
    if($num){
        $paged = ( get_query_var('paged') == 0 ? 1 : get_query_var('paged') );
        return $paged;
    }else{
      return $output;
    }
  }
