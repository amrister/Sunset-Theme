<?php
/*
	@package Sunset-theme
*/
	get_header();
?>
	<div class="content-area">
		<main class="site-main">
			<?php if(is_paged()): ?>
				<div class="container text-center">
					<a class="sunset-load-more"
					data-prev="1" data-page="<?php echo sunset_page_check(1);?>"
					data-archive = "<?php echo susnet_grab_page_url();?>"
					data-url="<?php echo admin_url('admin-ajax.php');?>">
						<span class="sunset-icon sunset-loading"></span>
						<span class="text">Load Previous</span>
					</a>
				</div>
			<?php endif; ?>
			<div class="page-header text-center">
				<?php the_archive_title('<h2 class="page-title">','</h2>')?>
			</div>
			<div class="container posts-container">
					<?php
						if(have_posts()){
							echo '<div class="page-limit" data-limit="'.$_SERVER["REQUEST_URI"].'">';
							while(have_posts()){
								the_post();
								set_query_var( 'post-show' , 'reveal' );
								get_template_part('template-parts/mypostformat',get_post_format());
							}
							echo '</div>';
						}
					?>
			</div>
			<div class="container text-center">
				<a
					class="sunset-load-more"
					data-page="<?php echo sunset_page_check(1);?>"
					data-archive = "<?php echo susnet_grab_page_url();?>"
					data-url="<?php echo admin_url('admin-ajax.php');?>" >
					<span class="sunset-icon sunset-loading"></span>
					<span class="text">Load More</span>
				</a>
			</div>
		</main>
	</div>

<?php get_footer(); ?>
