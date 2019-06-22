<?php
/*
	@package Sunset-theme
  This Template is Shortcodes
  ===========================
    Tooltip With Shortcodes
  ===========================
*/
  // [tooltip placement='top' title='This is title of tooltip '] This is tooltip content [/tooltip]
  function sunset_tooltip( $atts, $content = null ){

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
    PopUp With Shortcodes
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
