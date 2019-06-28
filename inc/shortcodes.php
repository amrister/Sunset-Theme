<?php
/*
	@package Sunset-theme
  This Template is Shortcodes
  ===========================
    Tooltip With Shortcode
  ===========================
*/
  function sunset_tooltip( $atts, $content = null ){
    // [tooltip placement='top' title='This is title of tooltip '] This is tooltip content [/tooltip]

    // Get the attributes
    $result = shortcode_atts(
        array(
          'placement' => 'top',
          'title'     => '',
        ),
        $atts,
        'tooltip'
    );
    $title = ( $result['title'] == '' ? $content : $result['title'] );

    // return HTML ( Always use return in shortcodes and not echo)
    return '<span class="sunset-tooltip" data-toggle="tooltip" data-placement="'.$result['placement'].'" title="'.$title.'">'.$content.'</span>';
  }
  add_shortcode( 'tooltip', 'sunset_tooltip');

/*
	===========================
    PopUp With Shortcode
  ===========================
*/
  function sunset_popover( $atts , $content = null){
    //  [popover title='' placement='' trigger='' content ] Content of it [/popover]
    //  [popover title="This is Title" trigger="click" content="This is test"  placement="top"]
    $result = shortcode_atts(
                  array(
                    'title' => '',
                    'placement' => 'right',
                    'trigger' => 'click',
                    'content' => '',
                  ),
                  $atts ,
                  'popup'
                );

    return '<span class="sunset-popover" data-toggle="popover" data-placement="'.$result['placement'].'" title="'.$result['title'].'" data-content="'.$result['content'].'" data-trigger="'.$result['trigger'].'">'.$content.'</span>';
  };
  add_shortcode( 'popover' , 'sunset_popover' );

/*
	===========================
    Contact Page Shortcode
  ===========================
*/
function sunset_contact_page( $atts, $content = null){

  //[contact_form]
  $atts = shortcode_atts(
    array(),
    $atts,
    'contact_form'
  );

  ob_start(); // Sva every comming output in buffer
  include 'templates/contact-form.php';
  return ob_get_clean(); // release buffer

}
add_shortcode( 'contact_form', 'sunset_contact_page' );
