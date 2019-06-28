<?php
/*
@package Sunset-theme
    ===============================
      Profile Widget CLASS
    ===============================
*/
class Sunset_Profile_Widget extends WP_Widget {

  public function __construct(){
    $widget_ops = array(
      'classname' => 'profile-widget',
      'description' => 'A profile widget for sidebar'
    );
    parent::__construct('sunset-profile', 'Sunset Profile',$widget_ops);
  }

  // Front-End Part
  function widget ($args ,$instance){

    $firstName = esc_attr( get_option('first_name'));
    $secondName = esc_attr( get_option('second_name'));
    $fullName = $firstName.' '.$secondName;
    $description = esc_attr( get_option('description'));
    $profilePicutre = esc_attr( get_option('profile_picture') );
    $fb_handler = esc_attr( get_option('fb_handler') );
    $twitterHandler = esc_attr( get_option('twitter_handler') );
    $gitHandler = esc_attr( get_option('github_handler') );

    echo $args['before_widget'];
    ?>
      <div class="widget-container">
        <div class="image" id='profile-picture-preview' style = "background-image: url(<?php print $profilePicutre; ?>) ">
        </div>
        <h5><?php print $fullName; ?></h5>
        <p><?php print $description ?></p>
        <div class="icons-wraper">
          <ul class="list-unstyled">
            <?php if ( ! empty( $fb_handler ) ): ?>
                <li><a href="https://www.facebook.com/<?php echo $fb_handler; ?>" target="_blank" ><span class="sunset-icon sunset-facebook"></span></a></li>
            <?php endif; ?>
            <?php if ( ! empty( $twitterHandler ) ): ?>
                <li><a href="https://www.twitter.com/<?php echo $twitterHandler; ?>" target="_blank"><span class="sunset-icon sunset-twitter"></span></a></li>
            <?php endif; ?>
            <?php if ( ! empty( $gitHandler ) ): ?>
                <li><a href="https://www.github.com/<?php echo $gitHandler; ?>" target="_blank"><span class="sunset-icon sunset-github"></span></a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    <?php
    echo $args['after_widget'];

  }

  // Admin Menu Part
  function form(){
    echo "<p><strong>No option for this widget</strong><br>";
    echo "You can fully customise this widget from <a href='./admin.php?page=amr_sunset'>this page</a></p>";
  }

}
add_action( 'widgets_init', function(){
  register_widget( 'Sunset_Profile_Widget' );
});

/*
    ===============================
      Edit Tag Cloud
    ===============================
*/
function sunset_tag_cloud_change($args){
  $args['smallest'] = 8;
  $args['largest'] = 8;

  return $args;
}
add_filter( 'widget_tag_cloud_args', 'sunset_tag_cloud_change');

/*
    ===============================
      Edit Category link
    ===============================
*/
function susnet_edit_widget_cat_link($links){
  $links = str_replace('</a> (','</a><span>',$links);
  $links = str_replace(')','</span>',$links);
  return $links;
}
add_action('wp_list_categories','susnet_edit_widget_cat_link');
/*
    ===============================
      Get and Set View Count
    ===============================
*/
function sunset_adjust_post_views( $postID ){

  $key = 'sunset_post_views';
  $value = get_post_meta( $postID , $key , true );

  $count = ( empty($value) ) ? 0 : $value;
  $count++;

  update_post_meta( $postID , $key , $count );

  // echo'<h1>'.$count.'</h1>';
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head');

/*
    ===============================
      Popular Posts Widget CLASS
    ===============================
*/
class Sunset_Popular_Posts_Widget extends WP_Widget{

  public function __construct(){
      $widget_ops = array(
        'classname' => 'popular-posts',
        'description' => 'Widget to show the most popular posts in the website',
      );
      parent::__construct('susnet-popular-posts','Popalur Posts',$widget_ops);
  }

  // Admin Menu part
  public function form( $instance ){

    $title = ( !empty( $instance['title'] ) ) ? $instance['title'] : 'Popular Posts';
    $totalNumber = ( !empty( $instance['tot'] ) ) ? absint($instance['tot']) : 4;

    $output = '<p>';
    $output .= '<label for="'.esc_attr( $this->get_field_id( 'title' ) ).'" >Title:</label>';
    $output .= '<input type="text" id="'.esc_attr( $this->get_field_id( 'title' ) ).'" class="widefat" name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr($title).'" >';
    $output .= '</p>';


    $output .= '<p>';
    $output .= '<label for="'.esc_attr( $this->get_field_id( 'tot' ) ).'">Number of posts: </label>';
    $output .= '<input type="number" name="'.esc_attr( $this->get_field_name( 'tot' ) ).'" id="'.esc_attr( $this->get_field_id( 'tot' ) ).'" value="'.esc_attr($totalNumber).'" class="tiny-text"  step="1" min="1" size="3" >';
    $output .= '</p>';

    echo $output ;

  }

  // Updating part
  public function update( $newInstance, $oldInstance ){

    $instance = array();
    $instance['title'] = ( !empty( $newInstance['title'] ) ) ? strip_tags( $newInstance['title'] ) : '';
    $instance['tot'] = ( !empty( $newInstance['tot'] ) ) ? absint( strip_tags( $newInstance['tot'] ) ) : 0;

    return $instance;

  }

  // Front-End part
  public function widget( $args, $instance ){

    $title = $instance['title'];
    $totalNumber = absint( $instance['tot'] );
    $query_args = array(
      'post_type'  => 'post',
      'posts_per_page' => $totalNumber,
      'meta_key' => 'sunset_post_views',
      'orderby'  => 'meta_value_num',
      'order'    => 'DESC',
    );
    $popPosts = new WP_Query($query_args);

    echo $args['before_widget'];
    if( !empty($title) ){
        echo $args['before_title'].apply_filters('widget_title',$title).$args['after_title'];
    }
    if($popPosts->have_posts()){
      echo '<ul class="list-unstyled">';
        while($popPosts->have_posts()){
          $popPosts->the_post();
          $comments  = '<span>'.sunset_get_comments_statement().'</span>';
          // <a class="widget-post-title" href="'.get_permalink().'" target="_blank">'.get_the_title().'</a><div class="text-right"><a class="widget-comments" href="'.get_permalink().'" target="_blank"><span class="sunset-icon sunset-comment"></span>'.$comments.'</a></div>
          echo '<li>';
          echo '<div class="media">';
          echo '<img src="'.get_template_directory_uri().'/images/post-'.get_post_format().'.png" alt="icon" />';
          echo '<div class="media-body">';
          echo '<a class="widget-post-title" href="'.get_permalink().'" target="_blank">'.get_the_title().'</a><div class="text-right"><a class="widget-comments" href="'.get_permalink().'" target="_blank"><span class="sunset-icon sunset-comment"></span>'.$comments.'</a></div>';
          echo '</div>';
          echo '</div>';
          echo '</li>';
        }
      echo '</ul>';
    }
    echo $args['after_widget'];
  }

}
add_action( 'widgets_init', function () {
  register_widget( 'Sunset_Popular_Posts_Widget' );
} );
