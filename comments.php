<?php

/*
@package Sunset-theme
  This template is for comments section
*/

  if(post_password_required()){
    return;
  }

?>
  <div id="comments" class="comments-area">
    <?php if(have_comments()): ?>
      <h2 class="seciton-title">
        <?php
          $title = '<span>'.get_the_title().'</span>';
          printf(
            esc_html( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number()  , 'comments title', 'sunset-theme' ) ),
				              number_format_i18n( get_comments_number() ),
				              '<span>' . get_the_title() . '</span>'
          );
         ?>
      </h2>

      <?php sunset_get_comments_nav(); ?>

      <?php if( !comments_open() ){ echo '<p class="no-comments">'.esc_html_e('Sorry, Comments are closed.','sunset-theme').'</p>'; return; } ?>

      <div class="display-comments">
        <ol class="comments-list">
          <?php
            $args = array(
              'walker'            => null,
              'max_depth'         => '',
              'style'             => 'ol',
              'type'              => 'all',
              'page'              => null,
              'per_page'          =>  '',
              'callback'          => null,
              'end_callback'      => null,
              'avatar_size'       => 40,
              'reverse_top_level' => null,
              'childer_reverse'   => false,
              'format'            => 'html5',
              'short_ping'        =>  false,
              'echo'              => true
            );
            wp_list_comments($args);
          ?>
        </ol>
      </div>

      <?php sunset_get_comments_nav(); ?>

    <?php endif; ?>
    <?php
      $fields = array(
        'author'  => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" required placeholder=" Name" class="form-control"/><span class="required">*</span></p>',
        'email'   => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="245" required placeholder=" Email" class="form-control"/><span class="required">*</span></p>',
        'url'     => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="245" required placeholder=" Website" class="form-control"/><span class="required">*</span></p>',
        'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .'<label for="wp-comment-cookies-consent">' . __( 'Remember me in next time I   comment.' ) . '</label></p>',
      );
      $args = array(
        'logged_in_as'  => '',
        'class_submit'  => 'btn btn-dark',
        'label_submit'  => __('Submit Comment'),
        'fields'        => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"  class="form-control" placeholder="Enter Your Text"></textarea><span class="required">*</span></p>',

      );
      comment_form($args);
    ?>
  </div>
