<?php
/*
	@package Sunset-theme
  This Template is For Single Post Display
*/
	get_header();
?>
	<div class="content-area">
		<main class="site-main">
			<div class="container posts-container">
        <div class="row">
          <div class="col-8 offset-2">
            <?php
    					if(have_posts()){
    						while(have_posts()){
                  the_post();
									sunset_adjust_post_views(get_the_id());
                	get_template_part('template-parts/single-post',get_post_format());
                  echo sunset_post_navigation();
                  if(comments_open()){
                    comments_template();
                  }
                }
    					}
    				?>
          </div>
        </div>
			</div>
		</main>
	</div>

<?php get_footer(); ?>
