<?php

/*
	@package Sunset-theme
  This is Template For Ajax Functions

*/

  add_action('wp_ajax_nopriv_sunset_load_more','sunset_load_more'); // When User Call Function by ajax evenif not logged
  add_action('wp_ajax_sunset_load_more','sunset_load_more'); // When User Call Function by ajax and he logged

  add_action( 'wp_ajax_nopriv_sunset_contact_form_save', 'sunset_save_contact');
  add_action( 'wp_ajax_sunset_contact_form_save', 'sunset_save_contact');

/*
  ==============================
  Load More Posts in Home Page
  ==============================
*/
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

/*
  =====================================
    Save user Data from Contact Form
  =====================================
*/
  function sunset_save_contact(){

    $name = wp_strip_all_tags( $_POST['name'] );
    $email = wp_strip_all_tags( $_POST['email'] );
    $message = wp_strip_all_tags( $_POST['message'] );

    $postArr = array(
      'post_type' => 'sunset-contact',
      'post_status' => 'publish',
      'post_title' => $name,
      'post_content' => $message,
      'post_author' => 1,
      'meta_input' => array(
        '_contact_email_field' => $email,
      ),
    );
    $postID = wp_insert_post( $postArr );

    // Sending Email
    if( $postID !== 0 ){
        $to = get_bloginfo( 'admin_email');
        $subject= 'Sunset Contact Form - '.$email;
        $headers[]= 'From: '.get_bloginfo('name').' <'.$to.'>';
        $headers[]= 'Reply-to: '.$name.' <'.$email.'>';
        $headers[]= 'Content-Type: text/html: Charset=UTF-8';
        wp_mail( $to, $subject, $message, $headers );
    }


    // Returning response
    echo $postID;

    die();
  }
