<?php

/*
@package Sunset-theme
  =========================================
   Contact Post Type
  =========================================
*/

$cotnactActivation = get_option('activate_contact');
if(!empty($cotnactActivation)){

  add_action( 'init', 'sunset_custom_post_type');

  // Customize Columns
  add_filter( 'manage_sunset-contact_posts_columns', 'sunset_messages_columns' );
  add_action( 'manage_sunset-contact_posts_custom_column', 'sunset_messages_custom_columns', 10, 2); // 10 is when to do action , 2 is number of Pararmters

}

// Register Message Post Type
function sunset_custom_post_type(){

    $labels = array(
      'name' => 'Messages',
      'singular_name' => 'Message',
      'menu_name' => 'Messages',
      'name_admin_bar' => 'Message',
      'add_new_item' => 'Add New Message',
      'edit_item' => 'Edit Message'
    );
    $args = array(
      'labels' => $labels,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => 26,
      'menu_icon' => 'dashicons-email-alt',
      'supports' => array('title','editor','author'),
    );
    register_post_type('sunset-contact',$args);
}
// Customize New Columns
function sunset_messages_columns($columns){ // $columns is Passed For The Function By Filter
  $newColumns = array();
  $newColumns['title'] = 'Full Name';
  $newColumns['message'] = 'Messages';
  $newColumns['email'] = 'Email';
  $newColumns['date'] = 'Date';
  return $newColumns;
}
function sunset_messages_custom_columns( $column, $post_id){
  switch ($column) {
    case 'message':
       echo get_the_excerpt();
      break;
    case 'email':
      echo "Email Address";
      break;
  }
}
