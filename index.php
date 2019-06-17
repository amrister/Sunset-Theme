<?php
/*
	@package Sunset-theme
*/
	get_header();
?>
	<div class="content-area">
		<main class="site-main">
			<div class="container">
				<?php
					if(have_posts()){
						while(have_posts()){
							the_post();
							get_template_part('template-parts/mypostformat',get_post_format());
						}
					}
				?>
			</div>
		</main>
	</div>

<?php get_footer(); ?>
