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

  // Add Meta Boxes
  add_action( 'add_meta_boxes', 'sunset_contact_add_meta_box' );
  add_action( 'save_post', 'sunset_contact_save_email');
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
      $email =  get_post_meta( $post_id, '_contact_email_field', true);
      echo '<a href="mailto: '.$email.'">'.$email.'</a>';
      break;
  }
}

// Email Meta Box
function sunset_contact_add_meta_box () {
  add_meta_box( 'email_contact', 'User Email Address', 'sunset_contact_email_callback', 'sunset-contact' ,'side');
}
function  sunset_contact_email_callback($post){
  wp_nonce_field( 'sunset_contact_save_email', 'sunset_email_meta_nonce');

  $value = get_post_meta($post->ID,'_contact_email_field',true);

  echo '<label class="components-base-control__label" for="sunset_contact_email_field">Email Address: </label>';
  echo '<input class="components-text-control__input" type="text" name="sunset_contact_email_field" id="sunset_contact_email_field" value="'.$value.'">';
}
// Check Before Save
function sunset_contact_save_email( $post_id ){
  if( !isset($_POST['sunset_email_meta_nonce'])){
    return;
  }
  if( !wp_verify_nonce( $_POST['sunset_email_meta_nonce'], 'sunset_contact_save_email') ){
    return;
  }
  if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
    return;
  }
  if( !current_user_can( 'edit_post', $post_id)){
    return;
  }
  if( !isset( $_POST['sunset_contact_email_field'] ) ){
    return;
  }

  $meta_data = sanitize_text_field( $_POST['sunset_contact_email_field'] );
  update_post_meta( $post_id, '_contact_email_field', $meta_data);
}
